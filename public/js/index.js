'use strict';

document.addEventListener("DOMContentLoaded", function() {
    const loader = document.getElementById("loader");
    const body = document.querySelector("body")

    let navBar = document.querySelector("nav")

    let navParent = document.querySelector(".navbar-parent")
    let navItem = document.querySelector(".navbar-nav")
    let navThird = document.querySelector(".item-third")

    let navBarIcon = navBar.querySelector(".bars")

    window.addEventListener("load", function() {
        loader.classList.add("d-none")
        body.style.overflow = "initial";
    });

    window.addEventListener("scroll", function() {
        if (window.scrollY > 100) {
            navBar.style.backgroundColor = "rgba(0, 0, 0, 0.9)";
        } else {
            navBar.style.backgroundColor = "transparent";
        }
    });

    navBarIcon.addEventListener("click", function(e) {
        navParent.classList.toggle('open')
        navThird.classList.toggle('open')

        navItem.classList.toggle('open-nav')
        navThird.classList.toggle('open-nav')
    })

    let randomizeParent = document.querySelector('.randomize-parent')
    let randomzeBtn = randomizeParent.querySelector('.btn-randomize')
    let currentCard = randomizeParent.querySelector('.active')
    let backdrop_link = currentCard.querySelector(".backdrop_link").textContent

    randomzeBtn.addEventListener("click", function(e) {
        let randomCard = randomizeParent.querySelectorAll('.randomize.d-none')

        e.preventDefault()

        currentCard = randomizeParent.querySelector('.active')

        currentCard.classList.add('d-none')
        currentCard.classList.remove('active')

        let randomCardArray = Array.from(randomCard);
        let randomIndex = Math.floor(Math.random() * randomCardArray.length);
        let randomElement = randomCardArray[randomIndex];

        randomElement.classList.add('active')
        randomElement.classList.remove('d-none')

        currentCard = randomizeParent.querySelector('.active')
        backdrop_link = currentCard.querySelector(".backdrop_link").textContent

        currentCard.style.background =
            `linear-gradient(to bottom, rgba(0, 0, 0, .10) 25%, rgba(0, 0, 0, 0) 100%),
            linear-gradient(to bottom right, rgba(0, 0, 0, .50) 25%, rgba(0, 0, 0, .90) 100%),
            url(${backdrop_link})`;

        // Set the styles
        currentCard.style.backgroundPosition = "center";
        currentCard.style.backgroundRepeat = "no-repeat";
        currentCard.style.backgroundSize = "cover";
        currentCard.style.color = "white";
        currentCard.style.minHeight = "40vh";
    })

    currentCard.style.background =
            `linear-gradient(to bottom, rgba(0, 0, 0, .10) 25%, rgba(0, 0, 0, 0) 100%),
            linear-gradient(to bottom right, rgba(0, 0, 0, .50) 25%, rgba(0, 0, 0, .90) 100%),
            url(${backdrop_link})`;

    // Set the styles
    currentCard.style.backgroundPosition = "center";
    currentCard.style.backgroundRepeat = "no-repeat";
    currentCard.style.backgroundSize = "cover";
    currentCard.style.color = "white";
    currentCard.style.minHeight = "40vh";
});
