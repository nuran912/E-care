//tab sections
const tabs = document.querySelectorAll('.tab-button');
const all_content = document.querySelectorAll('.content');

tabs.forEach((tab,index) => {
    tab.addEventListener('click',(e) => {
        tabs.forEach(tab => {tab.classList.remove('active')});
        tab.classList.add('active');

        var line = document.querySelector('.line');
        line.style.width = e.target.offsetWidth + "px";
        line.style.left = e.target.offsetLeft + "px";

        all_content.forEach(content => {content.classList.remove('active')});
        all_content[index].classList.add('active');
    });
});

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