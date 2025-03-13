<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>
<div class="bg-white shadow-sm rounded-lg p-8">
    <div class="overflow-x-auto mb-4">
        <?= $content ?? ''; ?>
    </div>
</div>
<?= $this->endSection(); ?>