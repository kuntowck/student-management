<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <div class="mb-8">
        <?= $this->include('partials/tabs'); ?>
    </div>

    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <div class="mb-4">
        <form class="row" action="<?= base_url('reports/student-pdf') ?>" method="post" target="_blank">
            <div class="grid grid-cols-4 gap-4">
                <div class="">
                    <select name="study_program" class="form-select mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm cursor-pointer">
                        <option value="">Choose Study Program</option>
                        <?php foreach ($study_programs as $program): ?>
                            <option value="<?= $program; ?>">
                                <?= ucfirst($program) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="">
                    <select name="entry_year" class="form-select mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Choose Entry year</option>
                        <?php foreach ($entry_years as $year): ?>
                            <option value="<?= $year; ?>">
                                <?= $year ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2 cursor-pointer">Generate Report</button>
            </div>
        </form>
    </div>
</div>
</div>
<?= $this->endSection(); ?>