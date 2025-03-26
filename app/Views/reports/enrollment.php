<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <div class="mb-8">
        <?= $this->include('partials/tabs'); ?>
    </div>

    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <div class="grid grid-cols-2 items-center gap-4 mb-4">
        <form class="row" method="get" action="<?= site_url('reports/enrollment') ?>">
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input name="search" type="search" id="search" value="<?= !empty($filters['name']) ? $filters['name'] : (!empty($filters['student_id']) ? $filters['student_id'] : ''); ?>" class="block w-full p-4 ps-10 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Search Name or ID..." />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-center cursor-pointer">Search</button>
            </div>
        </form>

        <div>
            <a href="<?= base_url('reports/enrollment'); ?>" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-center">Reset</a>
        </div>

        <div class="mb-4">
            <form action="<?= site_url('reports/enrollment-excel'); ?>" method="get">
                <input type="hidden" name="search" value="<?= !empty($filters['name']) ? $filters['name'] : (!empty($filters['student_id']) ? $filters['student_id'] : ''); ?>">

                <button type="submit" class="px-4 py-2 bg-green-100 text-green-700 border border-green-200 font-semibold text-sm rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:bg-green-700 focus:ring-green-500 focus:ring-offset-2 text-center cursor-pointer">Export Excel</button>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto mb-4">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Study Program</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Code</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Academic Year</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($enrollments)): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Data is not found.</td>
                    </tr>
                <?php else: ?>
                    <?php $count = 1;
                    foreach ($enrollments as $enrollment): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $count++; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $enrollment->student_id ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $enrollment->student_name; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $enrollment->study_program; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?= $enrollment->semester; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $enrollment->course_code; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $enrollment->course_name; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?= $enrollment->academic_year; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= ucfirst($enrollment->status); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>