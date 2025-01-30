//view appointment details
const viewButtons = document.querySelectorAll(".view-button");

viewButtons.forEach((viewButton,index) => {
    viewButton.addEventListener("click",() => {
        const popup = document.getElementById(`popup-${index}`);
        if(popup) {
            popup.style.display = "flex";
        }
    })
})

document.addEventListener("click", (event) => {
    document.querySelectorAll(".popup").forEach((popup) => {
        if(popup.style.display === "flex" && (event.target === popup || event.target.classList.contains("submit"))) {
            popup.style.display = "none";
        }
    })
})

    