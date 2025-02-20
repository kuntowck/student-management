<div class="max-w-screen-xl mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Student List</h1>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jurusan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">IPK</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grades</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {students}
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{nim}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{nama}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{jurusan}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{semester}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{ipk}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{!status_cell!}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{!grades_cell!}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="student/profile/{nim}" class="text-indigo-600 hover:text-indigo-900">Profile</a>
                        </td>
                    </tr>
                    {/students}
                </tbody>
            </table>
        </div>
    </div>
</div>