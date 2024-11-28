document.addEventListener('DOMContentLoaded', function () {
    const createDoctorBtn = document.querySelector('button[name="create-doctor"]');

    const editDoctorBtns = document.querySelectorAll('.btn-edit');
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

    editDoctorBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            popupEdit.style.display = 'block';
            overlay.style.display = 'block';
        });
    });

    closePopupEditBtn.addEventListener('click', function () {
        popupEdit.style.display = 'none';
        overlay.style.display = 'none';
    });

    const editArticleImageInput = document.getElementById('edit-article-image');
    const editImagePreview = document.getElementById('edit-image-preview');

    editArticleImageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                editImagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
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

function openEditPopup(article) {
    document.getElementById('edit-article-id').value = article.article_id;
    document.getElementById('edit-title').value = article.title;
    document.getElementById('edit-category').value = article.category;
    document.getElementById('edit-description').value = article.description;
    document.getElementById('edit-content').value = article.content;
    document.getElementById('edit-image-preview').src = article.image_url;
    document.getElementById('image-url').value = article.image_url;
    document.getElementById('edit-article-image').value = article.image_url;
    document.querySelector('.popup-edit').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block';
}

function closeEditPopup() {
    document.querySelector('.popup-edit').style.display = 'none';
    document.querySelector('.overlay').style.display = 'none';
}

document.getElementById('edit-article-image').addEventListener('change', function (event) {
    const imagePreview = document.getElementById('edit-image-preview');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.add('show');
        };
        reader.readAsDataURL(file);
    }
});


