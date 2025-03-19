<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="bg-white shadow-sm rounded-lg p-8">
    <?php if (session('error')) :  ?>
        <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-4 py-2 rounded-sm mb-2">
            <?= session('error') ?? ''; ?>
        </div>
    <?php elseif (session('message')): ?>
        <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-4 py-2 rounded-sm mb-2">
            <?= session('message') ?? ''; ?>
        </div>
    <?php endif; ?>

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