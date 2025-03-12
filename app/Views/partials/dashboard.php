<?= $this->extend('layouts/main'); ?>
<?= $this->section('content'); ?>

<div class="w-full max-w-screen-xl mx-auto">
    <div class="bg-white shadow-sm rounded-lg p-8">
        <?php if (!empty(user())): ?>
            <h1>Hello, <?= user()->username; ?></h1>

            <?php foreach (user()->getRoles() as $role): ?>
                <p>Role: <?= $role; ?></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>



<?= $this->endSection(); ?>