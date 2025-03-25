<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <script src="<?= base_url('assets/js/pristine.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="flex flex-col min-h-screen bg-gray-50">
    <header>
        <?= $this->include('partials/header'); ?>
    </header>

    <main>
        <div class="w-full max-w-screen-xl mx-auto p-4">
            <?= $this->renderSection('content'); ?>
        </div>
    </main>

    <footer class="bg-white rounded-lg shadow-sm m-4">
        <?= $this->include('partials/footer'); ?>
    </footer>


    <?= $this->renderSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js">
    </script>

</html>