// Open the Modal
const imageModal = document.getElementById("imageModal")

function openModal() {
    document.getElementById("imageModal").style.display = "block";
}

// Close the Modal
function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
    showSlides(slideIndex = n);
}

const imageSlide = document.querySelectorAll('.imageSlide')
const addSlides = document.getElementById("addSlides");
const addThumbnail = document.getElementById("addThumbnail");

window.addEventListener('DOMContentLoaded', event => {
    imageSlide.forEach(img => {
        let imagePath = img.getAttribute('src')
        let slideNumber = img.getAttribute('data-slide-number')
        let slideCaption = img.getAttribute('data-slide-caption')
        addSlides.innerHTML +=
            '<div class="mySlides">\n' +
            //'    <div class="numbertext">' + slideNumber + ' / 4</div>\n' +
            '    <img src="' + imagePath + '" style="width:100%" alt="'+ slideCaption +'">\n' +
            '</div>'


        addThumbnail.innerHTML += '<img class="demo" src="' + imagePath + '" onclick="currentSlide(' + slideNumber + ')" alt="'+ slideCaption +'">'
    });
});

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    if (imageModal.style.display === 'block') {
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }
}
