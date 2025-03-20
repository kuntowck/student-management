<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <div class="mb-4">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-4 py-2 rounded-sm">
                <?= session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-4 py-2 rounded-sm">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <a href="<?= base_url('student/enrollment/create'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Course Registration
        </a>
    </div>

    <div class="overflow-x-auto mb-4">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Credit</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Academic Year</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $count = 1 ?>
                <?php foreach ($enrollments as $enrollment) : ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?= $count++; ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->student_name; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->course_name; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->course_credit; ?> Hours
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->academic_year; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->semester; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= view_cell('AcademicStatusCell', ['status' => $enrollment->status]); ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>