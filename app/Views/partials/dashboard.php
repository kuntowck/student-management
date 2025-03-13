<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="bg-white shadow-sm rounded-lg p-8">
    <?php if (!empty(user())): ?>
        <h1 class="text-xl font-bold">Hello, <?= user()->username; ?>!</h1>

        <?php foreach (user()->getRoles() as $role): ?>
            <p>Role: <?= $role; ?></p>
        <?php endforeach; ?>
    <?php else: ?>
        <h1 class="text-xl font-bold mb-6">
            Welcome to Student Management System
        </h1>
    <?php endif; ?>
</div>


<?= $this->endSection(); ?>