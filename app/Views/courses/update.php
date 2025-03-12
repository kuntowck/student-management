<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-4">Update Course</h1>
        <form method="post" action="/course/update/<?= $course['id']; ?>" class="space-y-4">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                <input type="text" id="code" name="code" value="<?= $course['code']; ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                <input type="text" id="name" name="name" value="<?= $course['name']; ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="credits" class="block text-sm font-medium text-gray-700">Credits</label>
                <input type="text" id="credits" name="credits" value="<?= $course['credits']; ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                <input type="text" id="semester" name="semester" value="<?= $course['semester']; ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <div class="flex items-center justify-between gap-4">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">Update</button>
                <a href="<?= base_url('lecturer/courses') ?>" class="text-sm text-blue-500 hover:underline cursor-pointer">Back to course list</a>
            </div>
    </div>
</div>
</form>
<?= $this->endSection() ?>