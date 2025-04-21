//file upload
const realFileButton = document.getElementById('real-file');
const customButton = document.getElementById('custom-button');
const customText = document.getElementById("custom-text");

customButton.addEventListener('click',() => {
    realFileButton.click();
});

realFileButton.addEventListener('change',() => {
    if (realFileButton.value) {
        customText.innerHTML = realFileButton.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    }
    else {
        customText.innerHTML = "No file chosen.";
    }
});

//edit popup box
// const editButtons = document.querySelectorAll(".private-edit-button");

// editButtons.forEach((editButton,index) => {
//     editButton.addEventListener("click",() => {
//         const popup = document.getElementById(`popup-${index}`);
//         if(popup) {
//             popup.style.display = "flex";
//         }
//     })
// })

// document.addEventListener("click", (event) => {
//     document.querySelectorAll(".popup").forEach((popup) => {
//         if(popup.style.display === "flex" && (event.target === popup || event.target.classList.contains("submit"))) {
//             popup.style.display = "none";
//         }
//     })
// })

document.addEventListener("DOMContentLoaded", () => {
    const editButtons = document.querySelectorAll(".private-edit-button");

    editButtons.forEach((editButton, index) => {
        editButton.addEventListener("click", () => {
            const popup = document.getElementById(`popup-${index}`);
            if (popup) {
                popup.style.display = "flex";
            }
        });
    });

    document.addEventListener("click", (event) => {
        document.querySelectorAll(".popup").forEach((popup) => {
            if (
                popup.style.display === "flex" && (event.target === popup || event.target.classList.contains("submit"))
            ) {
                popup.style.display = "none";
            }
        });
    });
});
