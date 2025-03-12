<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <?= $content ?? ''; ?>
    </div>
</div>
<?= $this->endSection(); ?>