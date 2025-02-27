<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-screen-xl mx-auto p-4">
    <div class="bg-white shadow-sm rounded-md p-6">
        <h1 class="text-2xl font-bold mb-4">Detail Course</h1>
        <div class="mb-4">
            <p class="text-lg font-semibold">
                Code: <?= $course['code']; ?>
            </p>
            <p class="text-lg font-semibold">
                Course Name: <?= $course['name']; ?>
            </p>
            <p class="text-lg font-semibold">
                Study Program: <?= $course['credits']; ?>
            </p>
            <p class="text-lg font-semibold">
                Semester: <?= $course['semester']; ?>
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>