<div class="max-w-screen-xl mx-auto p-4">
    <div class="bg-white shadow-sm rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{title}</h1>
        <div class="mb-4">
            <a href="/student/create" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Study Program</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entry Year</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GPA</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grades</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {students}
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{student_id}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{study_program}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{current_semester}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{entry_year}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{gpa}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{!status_cell!}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{!grades_cell!}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="student/profile/{id}" class="text-indigo-600 hover:text-indigo-900">Profile</a>
                            <a href="student/update/{id}" class="text-indigo-600 hover:text-indigo-900">Update</a>
                            <form action="student/delete/{id}" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    {/students}
                </tbody>
            </table>
        </div>
    </div>
</div>