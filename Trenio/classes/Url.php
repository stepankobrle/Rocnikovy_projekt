<?php
/**
 *
 * Přesměrovává na zadanou url adresu
 *
 * @param string $path - adresa, na kterou se má přesměrovat
 *
 * @return void
 *
 */

class Url{
    public static function redirectUrl($path) {
        if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] != "off") {
            $url_protocol = "https";
        } else {
            $url_protocol = "http";
        }


        header("location: $url_protocol://" . $_SERVER["HTTP_HOST"] . $path);
    }



   public static function previousUrl() {
        $previousUrl = isset($_SESSION['previous_url']) ? $_SESSION['previous_url'] : '../view_workout.php'; // Pokud není definována předchozí URL, použije se výchozí stránka
        unset($_SESSION['previous_url']); // Odstranění uložené URL z session proměnné
        header("Location: $previousUrl");
        exit();
    }

}