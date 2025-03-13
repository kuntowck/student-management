<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <div class="overflow-x-auto mb-4">
        <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>
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
        </div>
    </div>
</div>
<?= $this->endSection(); ?>