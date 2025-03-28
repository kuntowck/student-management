<?php

namespace App\Controllers;

use Myth\Auth\Controllers\AuthController as MythAuthController;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\GroupModel;

class Auth extends MythAuthController

{
    protected $auth;
    protected $config;
    protected $userModel;
    protected $groupModel;

    public function __construct()
    {
        parent::__construct();

        $this->userModel = new UserModel();
        $this->groupModel = new GroupModel();

        $this->auth = service('authentication');
    }

    public function login()
    {
        return parent::login();
    }

    public function attemptLogin()
    {
        parent::attemptLogin();

        if (!user_id()) {
            return redirect()->back()->withInput()->with('error', 'Please check your credentials.');
        }

        return $this->redirectBasedOnRole();
    }

    public function register()
    {
        return parent::register();
    }

    public function attemptRegister()
    {
        return parent::attemptRegister();

        if ($this->users->errors()) {
            return redirect()->back()->withInput()->with('errors', $this->users->errors());
        }
    }

    private function redirectBasedOnRole()
    {
        $userId = user_id();

        if ($userId === null) {
            return redirect()->back();
        }

        $userGroups = $this->groupModel->getGroupsForUser($userId);

        foreach ($userGroups as $group) {
            if ($group['name'] === 'admin') {

                return redirect()->to('admin/dashboard');
            } else if ($group['name'] === 'lecturer') {

                return redirect()->to('lecturer/dashboard');
            } else if ($group['name'] === 'student') {

                return redirect()->to('student/dashboard');
            }
        }

        return redirect()->to('/');
    }
}
