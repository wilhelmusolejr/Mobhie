'use strict'

let header = document.querySelector('header')
let backdrop_link = document.querySelector(".backdrop_link").textContent
let headerStyles = window.getComputedStyle(header);

if(header.classList.contains('header-semi-dark')) {
    header.style.background =
    `linear-gradient(to bottom, rgba(0, 0, 0, .50) 25%, rgba(0, 0, 0, 0) 100%),
    linear-gradient(to bottom right, rgba(0, 0, 0, .50) 25%, rgba(0, 0, 0, 0) 100%),
    url(${backdrop_link})`;
} else {
    header.style.background =
    `linear-gradient(to bottom, rgba(0, 0, 0, .60) 25%, rgba(0, 0, 0, 0) 100%),
    linear-gradient(to bottom right, rgba(0, 0, 0, .60) 25%, rgba(0, 0, 0, .80) 100%),
    url(${backdrop_link})`;
}

// Set the styles
header.style.backgroundPosition = "center";
header.style.backgroundRepeat = "no-repeat";
header.style.backgroundSize = "cover";
header.style.color = "white";
