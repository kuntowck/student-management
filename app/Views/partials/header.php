<nav class="bg-white border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <?php if (!empty(user_id())): ?>
            <?php foreach (user()->getRoles() as $role): ?>
                <a href="<?= base_url('/' . $role . '/dashboard'); ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <!-- <img src="" class="h-8" alt="Logo" /> -->
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">Student Management</span>
                </a>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                        <li>
                            <a href="<?= base_url('/' . $role . '/dashboard'); ?>" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Dashboard</a>
                        </li>

                        <?php if (in_groups('admin')): ?>
                            <li>
                                <a href="<?= base_url('/' . $role . '/users'); ?>" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">User</a>
                            </li>

                            <li>
                                <a href="<?= base_url('/' . $role . '/students'); ?>" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Student</a>
                            </li>
                        <?php endif; ?>

                        <?php if (in_groups('lecturer')): ?>
                            <li>
                                <a href="<?= base_url('/' . $role . '/courses'); ?>" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Course</a>
                            </li>
                        <?php endif; ?>

                        <?php if (in_groups('student')): ?>
                            <li>
                                <a href="<?= base_url('/' . $role . '/enrollment'); ?>" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Enrollment</a>
                            </li>

                            <li>
                                <a href="<?= base_url('/' . $role . '/profile'); ?>" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Profile</a>
                            </li>
                        <?php endif; ?>

                        <li>
                            <?php if (logged_in()): ?>
                                <a href="/logout" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Logout</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <a href="<?= base_url('/'); ?>" class="flex items-center space-x-3 rtl:space-x-reverse">
                <!-- <img src="" class="h-8" alt="Logo" /> -->
                <span class="self-center text-2xl font-semibold whitespace-nowrap">Student Management</span>
            </a>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <a href="/login" class="block py-2 px-3 text-gray-500 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 ">Login</a>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</nav>