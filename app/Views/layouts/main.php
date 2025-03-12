<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="<?= base_url('assets/js/pristine.js') ?>"></script>
</head>

<body class="flex flex-col bg-gray-50">

    <header>
        <?= $this->include('partials/header'); ?>
    </header>

    <main class="flex flex-grow container mx-auto">
        <aside class="w-sm p-6">
            <?= $this->include('partials/sidebar'); ?>
        </aside>
        <section class="w-full p-6">
            <?= $this->renderSection('content'); ?>
        </section>
    </main>

    <footer class="bg-white rounded-lg shadow-sm m-4">
        <?= $this->include('partials/footer'); ?>
    </footer>

    <?= $this->renderSection('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js">
    </script>
</body>

</html>