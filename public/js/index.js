'use strict';

let navBar = document.querySelector("nav")

let navParent = document.querySelector(".navbar-parent")
let navItem = document.querySelector(".navbar-nav")
let navThird = document.querySelector(".item-third")

let navBarIcon = navBar.querySelector(".bars")

window.addEventListener("scroll", function() {
    if (window.scrollY > 100) {
        navBar.style.backgroundColor = "rgba(0, 0, 0, 0.9)";
    } else {
        navBar.style.backgroundColor = "transparent";
    }
});

navBarIcon.addEventListener("click", function(e) {
    console.log('t')

    navParent.classList.toggle('open')
    navThird.classList.toggle('open')

    navItem.classList.toggle('open-nav')
    navThird.classList.toggle('open-nav')
})

