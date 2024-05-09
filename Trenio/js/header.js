// Výběr HTML tagů, se kterými budeme pracovat
const menuIcon = document.querySelector(".menu-icon")
const navigation = document.querySelector("nav")
const hamburgerIcon = document.querySelector(".bx")

menuIcon.addEventListener("click", () => {
    if (hamburgerIcon.classList[1] === "bx-menu") {
        hamburgerIcon.classList.remove("bx-menu")
        hamburgerIcon.classList.add("bx-x")
        navigation.style.display = "block"
    } else {
        hamburgerIcon.classList.remove("bx-x")
        hamburgerIcon.classList.add("bx-menu")
        navigation.style.display = "none"
    }
})
