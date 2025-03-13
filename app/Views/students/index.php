<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <div class="mb-4">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-4 py-2 rounded-sm">
                <?= session()->getFlashdata('message'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-4 py-2 rounded-sm">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mb-4">
        <form action="<?= $baseURL; ?>" method="get">
            <div class="mb-4">
                <div class="flex-wrap items-center gap-4">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input name="search" type="search" id="default-search" value="<?= $params->search; ?>" class="block w-full p-4 ps-10 text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Search user..." />
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm px-4 py-2">Search</button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
                    <div class="">
                        <select name="studyProgram" class="form-select mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="this.form.submit()">
                            <option value="">All study program</option>
                            <?php foreach ($studyProgram as $program): ?>
                                <option value="<?= $program; ?>" <?= ($params->studyProgram === $program) ? 'selected' : '' ?>>
                                    <?= ucfirst($program) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="">
                        <select name="status" class="form-select mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="this.form.submit()">
                            <option value="">All academic status</option>
                            <?php foreach ($statuses as $status): ?>
                                <option value="<?= $status; ?>" <?= ($params->status === $status) ? 'selected' : '' ?>>
                                    <?= ucfirst($status) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="">
                        <select name="entryYear" class="form-select mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="this.form.submit()">
                            <option value="">All entry year</option>
                            <?php foreach ($entryYears as $year): ?>
                                <option value="<?= $year; ?>" <?= ($params->entryYear === $year) ? 'selected' : '' ?>>
                                    <?= ucfirst($year) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="">
                        <select name="perPage" class="form-select mt-1 block w-full px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" onchange="this.form.submit()">
                            <option value="2" <?= $params->perPage === 2 ? 'selected' : ''; ?>>2 page</option>
                            <option value="4" <?= $params->perPage === 4 ? 'selected' : ''; ?>>4 page</option>
                        </select>
                    </div>

                    <div class="">
                        <a href="<?= $params->getResetUrl($baseURL); ?>" class="w-full px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-center">Reset</a>
                    </div>
                </div>
            </div>

            <input type="hidden" name="sort" value="<?= $params->sort; ?>">
            <input type="hidden" name="order" value="<?= $params->order; ?>">
        </form>
    </div>

    <div class="mb-4">
        <a href="<?= base_url('admin/students/create'); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Create
        </a>
    </div>

    <div class="overflow-x-auto mb-4">
        <?= $content ?? ''; ?>
    </div>

    <div class="mb-4 text-center">
        <?= $pager->links('students', 'custom_pager'); ?>
    </div>

    <div class="mb-4 text-center">
        <small>
            Showing <?= $total ?> total data | Page <?= $params->page ?>
        </small>
    </div>
</div>
<?= $this->endSection(); ?>