<h1 class="text-2xl font-bold mb-4">{title}</h1>
{student}
<div class="mb-4">
    <p class="text-lg font-semibold">Name: {name}</p>
    <p class="text-lg font-semibold">Study Program: {study_program}</p>
    <p class="text-lg font-semibold">Entry Year: {entry_year}</p>
    <p class="text-lg font-semibold">Status: Semester {current_semester} {!status_cell!}</p>
</div>
{/student}
<div>
    <h1 class="text-lg font-bold mb-2">Course Enrollments</h1>
    <div class="overflow-x-auto font-semibold">
        {!grades_cell!}
    </div>
</div>