<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-4">Tambah Mahasiswa</h1>
<form method="post" action="/student/create" class="space-y-4">
    <?= csrf_field(); ?>

    <div>
        <label for="student_id" class="block text-sm font-medium text-gray-700">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
        <input type="text" id="name" name="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="study_program" class="block text-sm font-medium text-gray-700">Study Program:</label>
        <input type="text" id="study_program" name="study_program" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="current_semester" class="block text-sm font-medium text-gray-700">Semester:</label>
        <input type="text" id="current_semester" name="current_semester" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="academic_status" class="block text-sm font-medium text-gray-700">Status:</label>
        <input type="text" id="academic_status" name="academic_status" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="entry_year" class="block text-sm font-medium text-gray-700">Entry Year:</label>
        <input type="text" id="entry_year" name="entry_year" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <label for="gpa" class="block text-sm font-medium text-gray-700">GPA:</label>
        <input type="text" id="gpa" name="gpa" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div>
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Tambah</button>
    </div>
</form>
<a href="/student" class="text-indigo-600 hover:text-indigo-900">Kembali ke Daftar Mahasiswa</a>
<?= $this->endSection() ?>