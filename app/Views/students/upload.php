<?= $this->extend('layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="bg-white shadow-sm rounded-lg p-8">
    <h1 class="text-2xl font-bold mb-4"><?= $title; ?></h1>

    <?php if (session('validation_errors')): ?>
        <?php foreach (session('validation_errors') as $error): ?>
            <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-4 py-2 rounded-sm mb-2">
                <?= $error ?>
            </div>
        <?php endforeach ?>
    <?php endif; ?>

    <!-- <form id="upload-form" action="student/profile/upload" method="post" enctype="multipart/form-data" novalidate> -->

    <?= form_open_multipart('student/profile/upload', ['id' => 'upload-form', 'class' => 'pristine-validate']) ?>

    <div class="mb-4">
        <label for="highschool_diploma_file" class="block mb-2 text-sm font-medium text-gray-900">
            High School Diploma Upload File
        </label>
        <input
            type="file"
            name="highschool_diploma_file"
            id="highschool_diploma_file"
            size="20"
            required
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
            data-pristine-required-message="Please select a file to upload.">
        <p class="mt-1 text-sm text-gray-500" id="file_input_help">Only PDF (MAX. 5MB).</p>

        <div id="file-type-error" class="text-xs text-red-800 text-xs font-medium mt-2" style="display: none;">
            File must be in PDF.
        </div>

        <div id="file-size-error" class="text-xs text-red-800 mt-2" style="display: none;">
            File size must not exceed 5MB
        </div>
    </div>


    <div id="preview-container" class="mb-4" src="#" alt="File Preview" style="display: none;">
        Preview:
        <iframe id="file-preview" class="w-xs h-48" frameborder="0"></iframe>
    </div>

    <div class="flex items-center justify-between gap-4">
        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 cursor-pointer">Upload</button>
        <a href="<?= base_url('student/profile'); ?>" class="text-sm text-blue-500 hover:underline cursor-pointer">Back to Profile</a>
    </div>
    </form>
</div>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let form = document.getElementById("upload-form");

        var pristine = new Pristine(form);

        var fileInput = document.getElementById('highschool_diploma_file');
        var fileTypeError = document.getElementById('file-type-error');
        var fileSizeError = document.getElementById('file-size-error');
        var previewContainer = document.getElementById('preview-container');
        var filePreview = document.getElementById('file-preview');

        var maxSize = 5 * 1024 * 1024;
        var allowedTypes = ['application/pdf'];
        var allowedExtensions = ['.pdf'];

        pristine.addValidator(fileInput, function(value) {
            fileTypeError.style.display = 'none';
            fileSizeError.style.display = 'none';
            filePreview.style.display = 'none';

            if (fileInput.files.length === 0) {
                return true;
            }

            var file = fileInput.files[0]
            var validType = allowedTypes.includes(file.type);

            if (!validType) {
                var fileName = file.name.toLowerCase();
                validType = allowedExtensions.some(function(ext) {
                    return fileName.endsWith(ext);
                });
            }

            if (!validType) {
                fileTypeError.style.display = 'block';
                return false;
            }

            if (file.size > maxSize) {
                fileSizeError.style.display = 'block';
                return false;
            }

            var reader = new FileReader();
            reader.onload = function(e) {
                filePreview.src = e.target.result;
                filePreview.style.display = 'block';
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);


            return true;
        }, "Validasi file gagal", 5, false);


        form.addEventListener('submit', function(e) {
            var valid = pristine.validate();
            if (!valid) {
                e.preventDefault();
            }
        });

        fileInput.addEventListener('change', function() {
            var fileURL = URL.createObjectURL(file);

            fileTypeError.style.display = 'none';
            fileSizeError.style.display = 'none';
            filePreview.style.display = 'none';

            pristine.validate(fileInput);
        });
    })
</script>

<?= $this->endSection() ?>