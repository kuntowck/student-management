<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-4">Update Student</h1>
<form id="formData" method="post" action="/student/update/<?= $student['id']; ?>" class="space-y-4" novalidate>
    <?= csrf_field(); ?>
    <input type="hidden" name="_method" value="PUT">

    <div>
        <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID:</label>
        <input
            type="text"
            id="student_id"
            name="student_id"
            value="<?= $student['student_id']; ?>"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="Student ID is required"
            data-pristine-minlength="3"
            data-pristine-minlength-message="Student ID must be at leat 3 characters long.">
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
        <input
            type="text"
            id="name"
            name="name"
            value="<?= $student['name']; ?>"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="Name is required">
    </div>

    <div>
        <label for="study_program" class="block text-sm font-medium text-gray-700">Study Program:</label>
        <input
            type="text"
            id="study_program"
            name="study_program"
            value="<?= $student['study_program']; ?>"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="Study Program is required">
    </div>

    <div>
        <label for="current_semester" class="block text-sm font-medium text-gray-700">Semester:</label>
        <input
            type="number"
            id="current_semester"
            name="current_semester"
            value="<?= $student['current_semester']; ?>"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="Semester is required">

        <div class="text-red-800 text-xs font-medium mt-2">
            <?= session('errors.current_semester') ?? ''; ?>
        </div>
    </div>

    <div>
        <label for="academic_status" class="block text-sm font-medium text-gray-700">Status:</label>
        <input
            type="text"
            id="academic_status"
            name="academic_status"
            value="<?= $student['academic_status']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="Academic status is required">

        <div class="text-red-800 text-xs font-medium mt-2">
            <?= session('errors.academic_status') ?? ''; ?>
        </div>
    </div>

    <div>
        <label for="entry_year" class="block text-sm font-medium text-gray-700">Entry Year:</label>
        <input
            type="text"
            id="entry_year"
            name="entry_year"
            value="<?= $student['entry_year']; ?>" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="Entry year is required">
    </div>

    <div>
        <label for="gpa" class="block text-sm font-medium text-gray-700">GPA:</label>
        <input
            type="text"
            id="gpa"
            name="gpa"
            value="<?= $student['gpa']; ?>"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            data-pristine-required
            data-pristine-required-message="GPA is required">

        <div class="text-red-800 text-xs font-medium mt-2">
            <?= session('errors.gpa') ?? ''; ?>
        </div>
    </div>

    <div class="form-element flex items-center justify-between gap-4">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update</button>
        <a href="/student" class="text-sm text-blue-500 hover:underline">Back to student list</a>
    </div>
</form>
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