$(document).ready(function() {
    $('.addExerciseBtn').click(function(e) {
        e.preventDefault();
        var exerciseId = $(this).data('exercise-id');
        var workoutId = $(this).data('workout-id');

        $.ajax({
            url: 'add_to_table_workout_exercise.php',
            method: 'POST',
            data: { exercise_id: exerciseId, workout_id: workoutId },
                success: function(response) {
                    // Zpracování odpovědi ze serveru (pokud potřeba)
                    //alert('Cvik byl úspěšně přidán.');
                    $('#myModal').hide(); // Zavřít modální okno
                    location.reload(); // Aktualizovat stránku
                },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});