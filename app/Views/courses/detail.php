<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-md p-8">
        <h1 class="text-2xl font-bold mb-4">Detail Course</h1>
        <div class="mb-4">
            <p>
                <span class="font-semibold">Code: </span>
                <?= $course['code']; ?>
            </p>
            <p>
                <span class="font-semibold">Course Name: </span>
                <?= $course['name']; ?>
            </p>
            <p>
                <span class="font-semibold">Study Program: </span>
                <?= $course['credits']; ?>
            </p>
            <p>
                <span class="font-semibold">Semester: </span>
                <?= $course['semester']; ?>
            </p>
        </div>

        <div class="flex items-center justify-between gap-4">
            <a href="<?= base_url('lecturer/courses') ?>" class="text-sm text-blue-500 hover:underline cursor-pointer">Back to course list</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>