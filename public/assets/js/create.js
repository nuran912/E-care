document.addEventListener('DOMContentLoaded', function () {
    const createDoctorBtn = document.querySelector('button[name="create-doctor"]');

    const editDoctorBtns = document.querySelectorAll('.btn-edit');
    const popupEdit = document.querySelector('.popup-edit');
    const closePopupEditBtn = document.querySelector('.popup-edit .btn-cancel');

    const popup = document.querySelector('.popup');
    const closePopupBtn = document.querySelector('.popup .btn-cancel');
    const overlay = document.querySelector('.overlay');
    const doctorImageInput = document.getElementById('create-doctor-image');
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
            };
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

document.getElementById('create-doctor-image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('image-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('edit-doctor-image').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('edit-image-preview').src = e.target.result;
        };
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

function toggleStatus(button) {
    const form = button.closest('form');
    const isActive = button.classList.contains('btn-active');

    // Toggle button text and class
    button.textContent = isActive ? 'Disabled' : 'Active';
    button.classList.toggle('btn-active');
    button.classList.toggle('btn-disable');

    // Submit the form
    form.submit();
}

function resetPassword(button) {
    const form = button.closest('form');
    const name = form.querySelector('input[name="name"]').value;
    const nic = form.querySelector('input[name="nic"]').value;
    const confirmation = confirm(`Are you sure you want to change the password to the NIC (${nic}) of ${name}?`);

    if (confirmation) {
        form.submit();
    }
}

function doctorEditPopup(doctor) {
    document.getElementById('edit-doctor-id').value = doctor.id;
    document.getElementById('edit-user-id').value = doctor.user_id;
    document.getElementById('edit-doctor-name').value = doctor.name;
    document.getElementById('edit-doctor-nic').value = doctor.NIC;
    document.getElementById('edit-doctor-email').value = doctor.email;
    document.getElementById('edit-doctor-phone').value = doctor.phone_number;
    document.getElementById('edit-doctor-specialization').value = doctor.specialization;
    document.getElementById('edit-doctor-qualifications').value = doctor.other_qualifications;
    document.getElementById('edit-doctor-registration-number').value = doctor.registration_number;
    document.getElementById('edit-doctor-fee').value = doctor.Doctor_fee;
    document.getElementById('edit-doctor-note').value = doctor.special_note;
    document.getElementById('edit-doctor-government').checked = doctor.practicing_government_hospitals == 1;

    // document.getElementById('edit-doctor-hospital').value = doctor.hospital;
    
    // document.getElementById('edit-doctor-active').checked = doctor.is_active == 1;
    // document.getElementById('edit-image-preview').src = doctor.image_url;
    document.querySelector('.popup-edit').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block';
}

function clerkEditPopup(clerk, hospitals, labs) {
    document.getElementById('edit-clerk-id').value = clerk.emp_id;
    document.getElementById('edit-user-id').value = clerk.user_id;
    document.getElementById('edit-clerk-name').value = clerk.name;
    document.getElementById('edit-clerk-nic').value = clerk.NIC;
    document.getElementById('edit-clerk-email').value = clerk.email;
    document.getElementById('edit-clerk-phone').value = clerk.phone_number;
    document.getElementById('edit-clerk-type').value = clerk.type;

    // Match hospital name with the hospitals list and set the hospital ID
    const matchedHospital = hospitals.find(hospital => hospital.name === clerk.hospital);
    document.getElementById('edit-clerk-hospital').value = matchedHospital ? matchedHospital.id : '';

    // Match lab name with the labs list and set the lab ID
    const matchedLab = labs.find(lab => lab.name === clerk.lab);
    document.getElementById('edit-clerk-lab').value = matchedLab ? matchedLab.id : '';

    document.getElementById('edit-clerk-emp-id').value = clerk.emp_id;
    // document.getElementById('edit-image-preview').src = clerk.image_url;

    document.querySelector('.popup-edit').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block';
}

function hospitalEditPopup(hospital) {
    document.getElementById('edit-hospital-id').value = hospital.id;
    document.getElementById('edit-hospital-name').value = hospital.name;
    document.getElementById('edit-hospital-address').value = hospital.address;
    document.getElementById('edit-hospital-contact').value = hospital.contact;
    document.getElementById('edit-hospital-location').value = hospital.location;
    document.getElementById('edit-hospital-fee').value = hospital.hospital_fee;
    document.getElementById('edit-hospital-working').value = hospital.working_hours;
    document.getElementById('edit-hospital-des').value = hospital.description;

    // Extract services from <li> tags and match with checkbox values
    const services = hospital.services.match(/<li>(.*?)<\/li>/g)?.map(li => li.replace(/<\/?li>/g, '').trim()) || [];
    const serviceCheckboxes = document.querySelectorAll('.popup-edit input[type="checkbox"][name="services[]"]');
    serviceCheckboxes.forEach(checkbox => {
        checkbox.checked = services.includes(checkbox.value);
    });

    document.querySelector('.popup-edit').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block';
}

function labEditPopup(lab) {
    document.getElementById('edit-lab-id').value = lab.id;
    document.getElementById('edit-lab-name').value = lab.name;
    document.getElementById('edit-lab-address').value = lab.address;
    document.getElementById('edit-lab-contact').value = lab.contact;
    document.getElementById('edit-lab-location').value = lab.location;
    document.getElementById('edit-lab-fee').value = lab.lab_fee;
    document.getElementById('edit-lab-working').value = lab.working_hours;
    document.getElementById('edit-lab-des').value = lab.description;

    const services = lab.services.match(/<li>(.*?)<\/li>/g)?.map(li => li.replace(/<\/?li>/g, '').trim()) || [];
    const serviceCheckboxes = document.querySelectorAll('.popup-edit input[type="checkbox"][name="services[]"]');
    serviceCheckboxes.forEach(checkbox => {
        checkbox.checked = services.includes(checkbox.value);
    });
    document.querySelector('.popup-edit').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block';
}

// search functionality for doctors
function filterDoctors() {
    const searchInput = document.getElementById('search-doctor').value.toLowerCase();
    const tableRows = document.querySelectorAll('#doctor-table-body tr');

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td[data-search]');
        const matches = Array.from(cells).some(cell => 
            cell.getAttribute('data-search').toLowerCase().includes(searchInput)
        );
        row.style.display = matches ? '' : 'none';
    });
}

function filterUsers() {
    const searchInput = document.getElementById('search-users').value.toLowerCase();
    const tableRows = document.querySelectorAll('#user-table-body tr');

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td[data-search]');
        const matches = Array.from(cells).some(cell => 
            cell.getAttribute('data-search').toLowerCase().includes(searchInput)
        );
        row.style.display = matches ? '' : 'none';
    });
}

function filterClerks() {
    const searchInput = document.getElementById('search-clerks').value.toLowerCase();
    const tableRows = document.querySelectorAll('#clerk-table-body tr');

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td[data-search]');
        const matches = Array.from(cells).some(cell => 
            cell.getAttribute('data-search').toLowerCase().includes(searchInput)
        );
        row.style.display = matches ? '' : 'none';
    });
}
function filterHospitals() {
    const searchInput = document.getElementById('search-hospitals').value.toLowerCase();
    const tableRows = document.querySelectorAll('#hospitals-table-body tr');

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td[data-search]');
        const matches = Array.from(cells).some(cell => 
            cell.getAttribute('data-search').toLowerCase().includes(searchInput)
        );
        row.style.display = matches ? '' : 'none';
    });
}

function filterLabs() {
    const searchInput = document.getElementById('search-labs').value.toLowerCase();
    const tableRows = document.querySelectorAll('#labs-table-body tr');

    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td[data-search]');
        const matches = Array.from(cells).some(cell => 
            cell.getAttribute('data-search').toLowerCase().includes(searchInput)
        );
        row.style.display = matches ? '' : 'none';
    });
}

function toggleDropdowns() {
    const hospitalDropdown = document.getElementById('create-clerk-hospital');
    const labDropdown = document.getElementById('create-clerk-lab');

    if (hospitalDropdown.value) {
       labDropdown.disabled = true;
       labDropdown.value = "";
    } else {
       labDropdown.disabled = false;
    }

    if (labDropdown.value) {
       hospitalDropdown.disabled = true;
       hospitalDropdown.value = "";
    } else {
       hospitalDropdown.disabled = false;
    }
 }

 function toggleDropdownsEdit() {
    const hospitalDropdown = document.getElementById('edit-clerk-hospital');
    const labDropdown = document.getElementById('edit-clerk-lab');

    if (hospitalDropdown.value) {
        labDropdown.disabled = true;
        labDropdown.value = "";
     } else {
        labDropdown.disabled = false;
     }
 
     if (labDropdown.value) {
        hospitalDropdown.disabled = true;
        hospitalDropdown.value = "";
     } else {
        hospitalDropdown.disabled = false;
     }

 }



