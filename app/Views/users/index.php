<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

        <div class="mb-4">
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="mb-4">
            <a href="<?= base_url('admin/users/create'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Create
            </a>
        </div>

        <div class="mb-4">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $i = 1; ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $i++; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $user->email; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $user->username; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($user->active == 1): ?>
                                    <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Active</span>
                                <?php else: ?>
                                    <span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                $groupModel = new  \Myth\Auth\Models\GroupModel();
                                $groups = $groupModel->getGroupsForUser($user->id);
                                foreach ($groups as $group) {
                                    echo '<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">' . $group['name'] . '</span>';
                                }
                                ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="<?= base_url('admin/users/edit/' . $user->id); ?>" class="inline-block px-4 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Update</a>
                                <form action="<?= base_url('admin/users/delete/' . $user->id); ?>" method="post" class="inline-block">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="inline-block px-2 py-2 text-xs font-medium text-white focus:outline-none bg-red-500 rounded-md border border-red-200 hover:bg-red-700 hover:text-gray-200 focus:z-10 focus:ring-4 focus:ring-red-100 cursor-pointer">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>