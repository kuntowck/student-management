<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="max-w-screen-xl mx-auto p-4">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Course List</h1>
        <div class="mb-4">
            <a href="/course/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credits</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($courses as $course) : ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?= $course['code']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?= $course['name']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?= $course['credits']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?= $course['semester']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="course/detail/<?= $course['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Profile</a>
                                <a href="course/update/<?= $course['id']; ?>" class="text-indigo-600 hover:text-indigo-900">Update</a>
                                <form action="course/delete/<?= $course['id']; ?>" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>