document.getElementById("redirectBtn1").addEventListener("click", function() {
    // Přesměrování na jinou URL
    var workout_id = $(this).data('workout-id');
    window.location.href = "/Trenio/admin/one_workout.php?workout_id=" + workout_id;
});