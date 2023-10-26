import Dropzone from "dropzone";

Dropzone.autoDiscover = false;
if (document.getElementById('dropzone')) {
    const dropzone = new Dropzone('#dropzone', {
        dictDefaultMessage: 'Subí tu imagen acá',
        acceptedFiles: '.png, .jpg, .jpeg, .gif',
        addRemoveLinks: true,
        dictRemoveFile: 'Borrar archivo',
        maxFiles: 1,
        uploadMultiple: false,
        init: function () {
            if (document.querySelector('#image').value.trim()) {
                const uploadedImage = {};
                uploadedImage.size = 1234;
                uploadedImage.name = document.querySelector('#image').value.trim();
                this.options.addedfile.call(this, uploadedImage); // Opciones de dropzone
                this.options.thumbnail.call(
                    this,
                    uploadedImage,
                    `/uploads/${uploadedImage.name}`
                );
                uploadedImage.previewElement.classList.add(
                    "dz-success",
                    "dz-complete"
                );
            }
        },
    });

    dropzone.on('sending', function(file, xhr, formData) {
        console.log(file);
    });

    dropzone.on('success', function(file, response) {
        console.log(response);
        document.querySelector('#image').value = response.image;
    });

    dropzone.on('error', function(file, message) {
        console.log(message);
    });

    dropzone.on('removedfile', function() {
        console.log('Archivo eliminado');
        document.querySelector('#image').value = "";
    });
}