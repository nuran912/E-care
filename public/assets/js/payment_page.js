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
