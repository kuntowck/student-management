<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<div class="w-full bg-white rounded-lg shadow">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
            Create an account
        </h1>

        <?php if (session('error') !== null): ?>
            <div class="text-red-800 text-s font-medium mt-2">
                <?= session('error') ?? ''; ?>
            </div>
        <?php elseif (session('message') !== null): ?>
            <div class="text-green-500 text-s font-medium mt-2">
                <?= session('message') ?? ''; ?>
            </div>
        <?php endif; ?>

        <form class="space-y-4 md:space-y-6" action="<?= route_to('login'); ?>" method="post">
            <?= csrf_field(); ?>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="name@company.com">
            </div>
            <div>
                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Your username</label>
                <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5" placeholder="john doe">
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
            </div>
            <div>
                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
                <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5">
            </div>
            <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create an account</button>
            <p class="text-sm font-light text-gray-500">
                Already have an account? <a href="/login" class="font-medium text-blue-600 hover:underline">Login here</a>
            </p>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts'); ?>
<script>
    let pristine;
    window.onload = function() {
        let form = document.getElementById("formData");

        var pristine = new Pristine(form, {
            classTo: 'form-element',
            errorClass: 'is-invalid',
            successClass: 'is-valid',
            errorTextParent: 'form-element',
            errorTextTag: 'div',
            errorTextClass: 'text-red-800 text-xs font-medium mt-2'
        });

        form.addEventListener('submit', function(e) {
            var valid = pristine.validate();
            if (!valid) {
                e.preventDefault();
            }
        });

    };
</script>
<?= $this->endSection() ?>