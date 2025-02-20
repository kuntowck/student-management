<div class="max-w-screen-xl mx-auto p-4">
    <div class="bg-white shadow-sm rounded-md p-6">
        <h1 class="text-2xl font-bold mb-4">{title}</h1>
        {student}
        <div class="mb-4">
            <p class="text-lg font-semibold">Nama: {nama}</p>
            <p class="text-lg font-semibold">Jurusan: {jurusan}</p>
            <p class="text-lg font-semibold">Status: Semester {semester} {!status_cell!}</p>
        </div>
        {/student}
        <div>
            <h1 class="text-lg font-bold mb-2">Course Enrollments</h1>
            <div class="overflow-x-auto font-semibold">
                {!grades_cell!}
            </div>
        </div>
    </div>
</div>