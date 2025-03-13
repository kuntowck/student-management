<h1 class="text-2xl font-bold mb-4">{title}</h1>
{student}
<div class="mb-4">
    <p><span class="font-semibold">Name: </span>{name}</p>
    <p><span class="font-semibold">Study Program: </span>{study_program}</p>
    <p><span class="font-semibold">Entry Year: </span>{entry_year}</p>
    <p><span class="font-semibold">Status: </span>Semester {current_semester}
        | {!status_cell!}
    </p>
</div>
{/student}
<div>
    <h1 class="text-lg font-bold mb-2">Course Enrollments</h1>
    <div class="overflow-x-auto">
        {!grades_cell!}
    </div>
</div>