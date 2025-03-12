<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-4">Add Student</h1>
        <form id="formData" method="post" action="/student/create" class="space-y-4" novalidate>
            <?= csrf_field(); ?>

            <div class="form-element">
                <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID:</label>
                <input
                    type="text"
                    id="student_id"
                    name="student_id"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="Student ID is required"
                    data-pristine-minlength="3"
                    data-pristine-minlength-message="Student ID must be at leat 3 characters long."
                    value="<?= old('student_id') ?>">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.student_id') ?? ''; ?>
                </div>
            </div>

            <div class="form-element">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="Name is required"
                    value="<?= old('name') ?>">
            </div>

            <div class="form-element">
                <label for="study_program" class="block text-sm font-medium text-gray-700">Study Program:</label>
                <input
                    type="text"
                    id="study_program"
                    name="study_program"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="Study Program is required"
                    value="<?= old('study_program') ?>">
            </div>

            <div class="form-element">
                <label for="current_semester" class="block text-sm font-medium text-gray-700">Semester:</label>
                <input
                    type="number"
                    id="current_semester"
                    name="current_semester"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="Semester is required"
                    value="<?= old('cuurent_semester') ?>">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.current_semester') ?? ''; ?>
                </div>
            </div>

            <div class="form-element">
                <label for="academic_status" class="block text-sm font-medium text-gray-700">Status:</label>
                <input
                    type="text"
                    id="academic_status"
                    name="academic_status"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="Academic status is required"
                    value="<?= old('academic_status') ?>">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.academic_status') ?? ''; ?>
                </div>
            </div>

            <div class="form-element">
                <label for="entry_year" class="block text-sm font-medium text-gray-700">Entry Year:</label>
                <input
                    type="text"
                    id="entry_year"
                    name="entry_year"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="Entry year is required"
                    value="<?= old('entry_year') ?>">
            </div>

            <div class="form-element">
                <label for="gpa" class="block text-sm font-medium text-gray-700">GPA:</label>
                <input
                    type="text"
                    id="gpa"
                    name="gpa"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    data-pristine-required
                    data-pristine-required-message="GPA is required"
                    value="<?= old('gpa') ?>">

                <div class="text-red-800 text-xs font-medium mt-2">
                    <?= session('errors.gpa') ?? ''; ?>
                </div>
            </div>

            <div class="form-element flex items-center justify-between gap-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Tambah</button>
                <a href="<?= base_url('admin/students'); ?>" class="text-sm text-blue-500 hover:underline">Back to student list</a>
            </div>
        </form>
    </div>
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