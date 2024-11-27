document.addEventListener('DOMContentLoaded', function () {
    const createDoctorBtn = document.querySelector('button[name="create-doctor"]');

    const editDoctorBtn = document.querySelector('.btn-edit');
    const popupEdit = document.querySelector('.popup-edit');
    const closePopupEditBtn = document.querySelector('.popup-edit .btn-cancel');

    const popup = document.querySelector('.popup');
    const closePopupBtn = document.querySelector('.popup .btn-cancel');
    const overlay = document.querySelector('.overlay');
    const doctorImageInput = document.getElementById('doctor-image');
    const imagePreview = document.getElementById('image-preview');

    createDoctorBtn.addEventListener('click', function () {
        popup.style.display = 'block';
        overlay.style.display = 'block';
    });

    closePopupBtn.addEventListener('click', function () {
        popup.style.display = 'none';
        overlay.style.display = 'none';
    });

    overlay.addEventListener('click', function () {
        popup.style.display = 'none';
        overlay.style.display = 'none';
        popupEdit.style.display = 'none';

    });

    doctorImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    editDoctorBtn.addEventListener('click', function () {
        popupEdit.style.display = 'block';
        overlay.style.display = 'block';
    });

    closePopupEditBtn.addEventListener('click', function () {
        popupEdit.style.display = 'none';
        overlay.style.display = 'none';
    });
});

document.getElementById('doctor-image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('image-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

document.getElementById('edit-doctor-image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('edit-image-preview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
