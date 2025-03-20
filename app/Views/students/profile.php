<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <div class="overflow-x-auto mb-4">
        <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

        <div class="mb-4">
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-4 py-2 rounded-sm">
                    <?= session()->getFlashdata('message'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <a href="<?= base_url('student/profile/upload'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Upload File
            </a>
        </div>

        <div class="flex gap-16">
            <div class="mb-4">
                <p>
                    <span class="font-semibold">Student ID: </span>
                    <?= $student->__get('student_id'); ?>
                </p>
                <p>
                    <span class="font-semibold">Name: </span>
                    <?= $student->__get('name'); ?>
                </p>
                <p>
                    <span class="font-semibold">Username: </span>
                    <?= $student->__get('username'); ?>
                </p>
                <p>
                    <span class="font-semibold">Email: </span>
                    <?= $student->__get('email'); ?>
                </p>
                <p>
                    <span class="font-semibold">Study Program: </span>
                    <?= $student->__get('study_program'); ?>
                </p>
            </div>

            <div class="mb-4">
                <p>
                    <span class="font-semibold">Entry Year: </span>
                    <?= $student->__get('entry_year'); ?>
                </p>
                <p>
                    <span class="font-semibold">Semester: </span>
                    <?= $student->__get('current_semester'); ?>
                </p>
                <p>
                    <span class="font-semibold">Status: </span>
                    <?= view_cell('AcademicStatusCell', ['status' => $student->__get('academic_status')]); ?>
                </p>
                <p>
                    <span class="font-semibold">GPA: </span>
                    <?= $student->__get('gpa'); ?>
                </p>
                <p>
                    <span class="font-semibold">High School Diploma: </span>
                    <?php if (empty($student->__get('highschool_diploma_file'))) : ?>
                        No file uploaded
                    <?php else: ?>
                        <a
                            href="<?= base_url('student/profile/view-highschool-diploma?file=' . $student->__get('highschool_diploma_file')); ?>"
                            target="_blank"
                            class="text-blue-500 text-sm underline">
                            View Diploma
                        </a>
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>