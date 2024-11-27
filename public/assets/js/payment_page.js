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
            ? "Enter NIC number"
            : "Enter Passport number  (Passport number must start with N or P followed by 7 digits (e.g., N1234567))";
        // Optionally clear the input value
        idNumberInput.value = "";
      }
    });
  });
});
document.addEventListener('DOMContentLoaded', function () {
  const nicPattern = "([0-9]{12}|[0-9]{9}[vV])";
  const passportPattern = "[NP][0-9]{7}";
  const idNumberInput = document.getElementById('idNumber');
  const nicRadio = document.getElementById('nic');
  const passportRadio = document.getElementById('passport');

  function updatePattern() {
      if (nicRadio.checked) {
          idNumberInput.setAttribute('pattern', nicPattern);
          idNumberInput.setAttribute('placeholder', 'Enter NIC number');
      } else if (passportRadio.checked) {
          idNumberInput.setAttribute('pattern', passportPattern);
          idNumberInput.setAttribute('placeholder', 'Enter Passport number');
      }
  }

  nicRadio.addEventListener('change', updatePattern);
  passportRadio.addEventListener('change', updatePattern);

  // Initialize pattern on page load
  updatePattern();
});
