const serviceCharge = paymentData.serviceCharge;
const totalWithoutServiceCharge = paymentData.totalWithoutServiceCharge;

const serviceChargeContainer = document.getElementById(
  "service-charge-container"
);
const serviceChargeInput = document.getElementById("serviceCharge");
const serviceChargePreview = document.getElementById("serviceChargePreview");

serviceChargeContainer.style.display = "none";
serviceChargePreview.innerHTML = `Rs. ${totalWithoutServiceCharge}`;

serviceChargeInput.addEventListener("input", () => {
  serviceChargeContainer.style.display = serviceChargeInput.checked
    ? "flex"
    : "none";
  if (serviceChargeInput.checked) {
    const cleanServiceCharge = Number(serviceCharge.replace(/,/g, ""));
    const cleanTotalWithoutServiceCharge = Number(
      totalWithoutServiceCharge.replace(/,/g, "")
    );
    const totalAmount = cleanServiceCharge + cleanTotalWithoutServiceCharge;
    serviceChargePreview.innerHTML = `Rs. ${totalAmount.toFixed(2)}`;
  } else {
    serviceChargePreview.innerHTML = `Rs. ${totalWithoutServiceCharge}`;
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const radioButtons = document.getElementsByName("idType");
  const idNumberInput = document.getElementById("idNumber");

  // Event Listener for Radio Buttons
  radioButtons.forEach((radio) => {
    radio.addEventListener("change", () => {
      if (radio.checked) {
        // Update placeholder based on selected ID type
        idNumberInput.placeholder =
          radio.value === "nic"
            ? "Enter NIC number (NIC number must be 12 digits or 9 digits followed by 'v' or 'V')"
            : "Enter Passport number  (Passport number must start with N or P followed by 7 digits (e.g., N1234567))";
        // Optionally clear the input value
        idNumberInput.value = "";
      }
    });
  });
});
document.addEventListener("DOMContentLoaded", function () {
  const nicPattern = "([0-9]{12}|[0-9]{9}[vV])";
  const passportPattern = "[NP][0-9]{7}";
  const idNumberInput = document.getElementById("idNumber");
  const nicRadio = document.getElementById("nic");
  const passportRadio = document.getElementById("passport");

  function updatePattern() {
    if (nicRadio.checked) {
      idNumberInput.setAttribute("pattern", nicPattern);
      idNumberInput.setAttribute("placeholder", "Enter NIC number (NIC number must be 12 digits or 9 digits followed by 'v' or 'V')");
    } else if (passportRadio.checked) {
      idNumberInput.setAttribute("pattern", passportPattern);
      idNumberInput.setAttribute("placeholder", "Enter Passport number (Passport number must start with N or P followed by 7 digits (e.g., N1234567))");
    }
  }
f
  nicRadio.addEventListener("change", updatePattern);
  passportRadio.addEventListener("change", updatePattern);

  // Initialize pattern on page load
  updatePattern();
});

document.addEventListener("DOMContentLoaded", function () {
  const loggedpersonCheckbox = document.getElementById("isloggedperson");
  const patientNameInput = document.getElementById("patientName");
  const patientEmailInput = document.getElementById("patientEmail");
  const patientPhoneInput = document.getElementById("patientPhone");
  const idNumberInput = document.getElementById("idNumber");
  const title= document.getElementById("title");

  function updateFormFields() {
    if (loggedpersonCheckbox.checked) {
      patientNameInput.value = loggedpersonCheckbox.dataset.username;
      patientEmailInput.value = loggedpersonCheckbox.dataset.email;
      patientPhoneInput.value = loggedpersonCheckbox.dataset.contact;
      idNumberInput.value = loggedpersonCheckbox.dataset.idnumber;
      title.value = loggedpersonCheckbox.dataset.title;
    } else {
      patientNameInput.value = "";
      patientEmailInput.value = "";
      patientPhoneInput.value = "";
      idNumberInput.value = "";
      title.value = "";
    }
  }

  // Initial check on page load
  updateFormFields();

  // Add event listener for changes
  loggedpersonCheckbox.addEventListener("change", updateFormFields);
});

document.getElementById('selectDocumentsBtn').addEventListener('click', function() {
  document.getElementById('documentsPopup').style.display = 'block';
});

document.getElementById('closePopup').addEventListener('click', function() {
  document.getElementById('documentsPopup').style.display = 'none';
});

window.addEventListener('click', function(event) {
  if (event.target == document.getElementById('documentsPopup')) {
    document.getElementById('documentsPopup').style.display = 'none';
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form[name='patientForm']");
  const inputs = form.querySelectorAll("input, select");

  // inputs.forEach((input) => {
  //   input.addEventListener("input", () => {
  //     const errorMessage = input.nextElementSibling;
  //     if (input.validity.valid) {
  //       if (errorMessage && errorMessage.classList.contains("error-message")) {
  //         errorMessage.textContent = "";
  //       }
  //     } else {
  //       if (errorMessage && errorMessage.classList.contains("error-message")) {
  //         if (input.validity.valueMissing) {
  //           errorMessage.textContent = "This field is required.";
  //         } else if (input.validity.patternMismatch) {
  //           if (input.id === "patientPhone") {
  //             errorMessage.textContent = "Phone number must be exactly 10 digits.";
  //           } else if (input.id === "idNumber") {
  //             errorMessage.textContent = "Invalid NIC or Passport format.";
  //           }
  //         } else if (input.validity.typeMismatch) {
  //           if (input.id === "patientEmail") {
  //             errorMessage.textContent = "Please enter a valid email address.";
  //           }
  //         }
  //       }
  //     }
  //   });
  // });
});
