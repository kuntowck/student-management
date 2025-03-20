<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <?php if (session()->has('errors')) : ?>
        <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded-sm">
            <ul>
                <?php foreach (session('errors') as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif ?>

    <form method="post" action="<?= base_url('student/enrollment/create'); ?>" id="formData" class="space-y-4" novalidate>
        <?= csrf_field(); ?>

        <div class="form-element">
            <label for="course_id" class="form-label">Course</label>
            <select
                id="course_id"
                name="course_id"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm <?= (session('errors.course_id')) ? 'is-invalid' : ''; ?>"
                ata-pristine-required
                data-pristine-required-message="Course is required">
                <option value="">Choose Course</option>
                <?php foreach ($courses as $course) : ?>
                    <option value="<?= $course->id; ?>">
                        <?= $course->code; ?> | <?= $course->name; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <div class="text-red-800 text-xs font-medium mt-2">
                <?= session('errors.course'); ?>
            </div>
        </div>

        <div class="form-element">
            <label for="academic_year" class="block text-sm font-medium text-gray-700">Academic Year</label>
            <input
                type="number"
                value="2025"
                id="academic_year"
                name="academic_year"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm <?= (session('errors.academic_year')) ? 'is-invalid' : ''; ?>"
                value="<?= old('academic_year'); ?>"
                data-pristine-required
                data-pristine-required-message="Academic year is required"
                data-pristine-min="2024"
                data-pristine-min-message="Academic year must be at least 2024"
                data-pristine-max="2025"
                data-pristine-max-message="Academic year must be at most 2025">

            <div class="text-red-800 text-xs font-medium mt-2">
                <?= session('errors.academic_year'); ?>
            </div>
        </div>

        <div class="form-element">
            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
            <input
                type="number"
                value="1"
                id="semester"
                name="semester"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                value="<?= old('semester') ?>"
                data-pristine-required
                data-pristine-required-message="Semester is required"
                data-pristine-min="1"
                data-pristine-min-message="Semester must be at least 1"
                data-pristine-max="14"
                data-pristine-max-message="Semester must be at most 14">

            <div class="text-red-800 text-xs font-medium mt-2">
                <?= session('errors.semester'); ?>
            </div>
        </div>

        <div class="form-element">
            <label for="status" class="form-label">Status</label>
            <select
                id="status"
                name="status"
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm <?= (session('errors.status')) ? 'is-invalid' : ''; ?>"
                data-pristine-required
                data-pristine-required-message="Status is required">
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <div class="text-red-800 text-xs font-medium mt-2">
                <?= session('errors.status'); ?>
            </div>
        </div>

        <div class="flex items-center justify-between gap-4">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">Registration</button>
            <a href="<?= base_url('student/enrollment'); ?>" class="text-sm text-blue-500 hover:underline cursor-pointer">Back to Enrollment</a>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts'); ?>
<script>
    let pristine;
    window.onload = function() {
        let form = document.getElementById("formData");

        var pristine = new Pristine(form, {
            classTo: 'form-element',
            errorClass: 'is-invalid',
            successClass: 'is-valid',
            errorTextParent: 'form-element',
            errorTextTag: 'div',
            errorTextClass: 'text-red-800 text-xs font-medium mt-2'
        });

        form.addEventListener('submit', function(e) {
            var valid = pristine.validate();
            if (!valid) {
                e.preventDefault();
            }
        });

    };
</script>
<?= $this->endSection() ?>