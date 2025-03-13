<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <div class="overflow-x-auto mb-4">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Student Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Course Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Academic Year</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($enrollments as $enrollment) : ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->id; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->student_name; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?= $enrollment->course_name; ?>
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