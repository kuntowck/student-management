<?= $this->section('title'); ?>
<?= $title; ?>
<?= $this->endSection(); ?>

<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>
<?= $content ?? ''; ?>
<?= $this->endSection(); ?>