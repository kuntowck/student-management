<table class="w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            {tableHeader}
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <a href="{href}">
                    {name} {is_sorted}
                </a>
            </th>
            {/tableHeader}
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
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
            <td class="px-6 py-4 whitespace-nowrap">
                <a href="students/detail/{id}" class="inline-block px-4 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Detail</a>
                <a href="students/update/{id}" class="inline-block px-4 py-2 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Update</a>
                <form action="students/delete/{id}" method="post" class="inline-block">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="inline-block px-2 py-2 text-xs font-medium text-white focus:outline-none bg-red-500 rounded-md border border-red-200 hover:bg-red-700 hover:text-gray-200 focus:z-10 focus:ring-4 focus:ring-red-100 cursor-pointer">Delete</button>
                </form>
            </td>
        </tr>
        {/students}
    </tbody>
</table>