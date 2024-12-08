//tab sections
// document.addEventListener("DOMContentLoaded",() => {
//     const activeTab = document.querySelector('.tab-button.active');
//     const line = document.querySelector('.line');

//     if(activeTab && line) {
//         line.style.width = activeTab.offsetWidth + "px";
//         line.style.left = activeTab.offsetLeft + "px";
//     }
// })

// document.addEventListener("DOMContentLoaded",() => {
//     const tabs = document.querySelectorAll('.tab-button');
//     const line = document.querySelector('.line');

//     const updateLinePosition = (tab) => {
//         line.style.width = tab.offsetWidth + "px";
//         line.style.left = tab.offsetLeft + "px";
//     };

//     const activeTab = document.querySelector('.tab-button.active');
//     if(activeTab) {
//         updateLinePosition(activeTab);
//     }

//     tabs.forEach((tab) => {
//         tab.addEventListener('click',(event) => {
//             tabs.forEach((t) => t.classList.remove('active'));
//             tab.classList.add('active');
//             updateLinePosition(tab);
//         });
//     });
// });

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
const editButtons = document.querySelectorAll(".private-edit-button");

editButtons.forEach((editButton,index) => {
    editButton.addEventListener("click",() => {
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