<?= $this->extend('layouts/admin'); ?>

<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

        <div class="mb-6">
            <h1 class="text-lg font-reguler mb-2">Total Students</h1>
            <div class="text-lg font-bold text-gray-700"><?= $students; ?> Students</div>
        </div>

        <div>
            <h1 class="text-lg font-reguler mb-2">Total Courses</h1>
            <div class="text-lg font-bold text-gray-700"><?= $courses; ?> Courses</div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>