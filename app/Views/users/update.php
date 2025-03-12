<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

        <?php if (session()->has('errors')) : ?>
            <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm">
                <ul>
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form method="post" action="<?= base_url('admin/users/update/' . $user->id); ?>" class="space-y-4">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">

            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm <?= (session('errors.username')) ? 'is-invalid' : ''; ?>"
                    value="<?= old('username', $user->username); ?>">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.username'); ?>
                </div>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="<?= old('email', $user->email); ?>">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.email'); ?>
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.password'); ?>
                </div>
            </div>

            <div>
                <label for="pass_confirm" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                <input
                    type="password"
                    id="pass_confirm"
                    name="pass_confirm"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.pass_confirm'); ?>
                </div>
            </div>

            <div>
                <label for="group" class="form-label">Group</label>
                <select
                    id="group"
                    name="group"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm <?= (session('errors.group')) ? 'is-invalid' : ''; ?>">
                    <option value="">Choose group</option>
                    <?php $selected = false ?>
                    <?php foreach ($groups as $group) : ?>
                        <?php foreach ($userGroups as $userGroup) : ?>
                            <?php if ($userGroup['group_id'] == $group->id) : ?>
                                <?php $selected = true;
                                break; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <option value="<?= $group->id; ?>" <?= ($selected) ? 'selected' : ''; ?>>
                            <?= $group->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.group'); ?>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700" for="status">
                    Aktif
                </label>
                <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="checkbox" id="status" name="status" <?= ($user->active == 1) ? 'checked' : ''; ?>>
            </div>

            <div class="flex items-center justify-between gap-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">Update</button>
                <a href="<?= base_url('admin/users'); ?>" class="text-sm text-blue-500 hover:underline cursor-pointer">Back to user list</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>