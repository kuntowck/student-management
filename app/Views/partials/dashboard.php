<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<h1>Hello, <?= user()->username; ?></h1>

<?= $this->endSection(); ?>