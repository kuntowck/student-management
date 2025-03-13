<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Users extends BaseController
{
    protected $userModel;
    protected $groupModel;
    protected $db;
    protected $config;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();
        $this->db = \Config\Database::connect();
        $this->config = config('Auth');

        helper(['auth']);
        if (!in_groups('admin')) {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'User Management',
            'users' => $this->userModel->findAll()
        ];

        return view('users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Add New User',
            'groups' => $this->groupModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('users/create', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Update User',
            'user' => $this->userModel->find($id),
            'groups' => $this->groupModel->findAll(),
            'userGroups' => $this->groupModel->getGroupsForUser($id),
            'validation' => \Config\Services::validation()
        ];

        if (empty($data['user'])) {
            return redirect()->to('/users')->with('error', 'User is not found.');
        }

        return view('users/update', $data);
    }

    public function store()
    {
        $user = new \Myth\Auth\Entities\User();

        $user->username = $this->request->getVar('username');
        $user->email = $this->request->getVar('email');
        $user->password = $this->request->getVar('password');
        $user->active = 1;

        $this->userModel->save($user);

        // tambahkan user ke dalam group
        $newUser = $this->userModel->where('email', $user->email)->first();
        $userId = $newUser->id;

        $groupId = $this->request->getVar('group');
        $this->groupModel->addUserToGroup($userId, $groupId);

        return redirect()->to('admin/users')->with('message', 'User has been successfully added.');
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->to('/users')->with('error', 'User is not found.');
        }

        // cek username unik
        $newUsername = $this->request->getVar('username');

        if ($user->username !== $newUsername) {
            $existingUser = $this->userModel->where('email', $newUsername)->first();

            if ($existingUser) {
                return redirect()->back()->withInput()->with('error', 'Username already used.');
            }
        }

        // cek email unik
        $newEmail = $this->request->getVar('email');

        if ($user->email !== $newEmail) {
            $existingEmail = $this->userModel->where('email', $newEmail)->first();

            if ($existingEmail) {
                return redirect()->back()->withInput()->with('error', 'Email already used.');
            }
        }

        // cek password dan password confirm sesuai
        $password = $this->request->getVar('password');
        $passConfirm = $this->request->getVar('pass_confirm');

        if (!empty($password)) {
            if ($password != $passConfirm) {
                return redirect()->back()->withInput()->with('error', 'Password dan konfirmasi tidak sama');
            }
        }
        
        $newUser = new \Myth\Auth\Entities\User();
        
        $newUser->id = $id;
        $newUser->username = $newUsername;
        $newUser->email = $newEmail;
        $newUser->active = $this->request->getVar('status') ? 1 : 0;

        // Update password jika diisi
        if (!empty($password)) {
            $newUser->password = $password;
        }

        $this->userModel->save($newUser);

        // update user ke dalam group
        $groupId = $this->request->getVar('group');

        if (!empty($groupId)) {
            $currentGroup = $this->groupModel->getGroupsForUser($id);

            foreach ($currentGroup as $group) {
                $this->groupModel->removeUserFromGroup($id, $group['group_id']);
            }

            $this->groupModel->addUserToGroup($id, $groupId);
        }

        return redirect()->to('admin/users')->with('message', 'User has been successfully updated.');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (empty($user)) {
            return redirect()->to('/users')->with('error', 'User is not found.');
        }

        $this->userModel->delete($id);

        return redirect()->to('admin/users')->with('message', 'User has been successfully deleted.');
    }
}
