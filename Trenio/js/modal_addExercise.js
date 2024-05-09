
// Získání odkazu na modální okno
var modal = document.getElementById("myModal2");

// Získání odkazu na tlačítko pro otevření modálního okna
var btn = document.getElementById("openModalBtn2");

// Získání odkazu na prvek pro zavření modálního okna
var span = document.getElementById("close2");

// Při kliknutí na tlačítko otevřít modální okno
btn.onclick = function() {
    modal.style.display = "block"; // Zobrazení modálního okna
}

// Při kliknutí na prvek pro zavření modálního okna
span.onclick = function() {
    modal.style.display = "none"; // Skrytí modálního okna
}

// Při kliknutí mimo modální okno, skrýt modální okno
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none"; // Skrytí modálního okna
    }
}


