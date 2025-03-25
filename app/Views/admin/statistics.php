<?= $this->extend('layouts/admin'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="bg-white shadow-sm rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <div class="flex gap-4">
        <div class="flex-1 bg-blue-100 text-center p-8 rounded-lg">
            <h1 class="text-lg text-gray-600">Total Students</h1>
            <p class="text-lg font-bold text-blue-700"><?= $students; ?> Students</p>
        </div>

        <div class="flex-1 bg-green-100 text-center p-8 rounded-lg">
            <h1 class="text-lg text-gray-600">Total Courses</h1>
            <h3 class="text-lg font-bold text-green-700"><?= $courses; ?> Courses</h3>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>