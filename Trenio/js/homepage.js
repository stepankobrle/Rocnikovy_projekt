
/**********************
 Funkce pro zobrazení obsahu karty a označení tlačítka jako aktivní
 ************************/

function openTab(event, tabName) {
    // Získání všech elementů s třídou "tabcontent" a skryje je
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Získání všech tlačítek s třídou "tablink" a odebrání třídy "active"
    var tablinks = document.getElementsByClassName("tablink");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }

    // Zobrazí vybraný obsah karty a označí vybrané tlačítko jako aktivní
    document.getElementById(tabName).style.display = "block";
    event.currentTarget.classList.add("active");

    localStorage.setItem("activeTab", tabName);
}

// Funkce pro nastavení aktivního tabu při načtení stránky
window.onload = function() {
    var activeTab = localStorage.getItem("activeTab");
    if (activeTab) {
        var tabButton = document.querySelector(".tablink[data-tab='" + activeTab + "']");
        if (tabButton) {
            tabButton.click();
        }
    }
}