$(document).ready(function() {
    $('.addSeriesBtn').click(function(e) {
        e.preventDefault();
        var exerciseId = $(this).data('exercise-id');
        var workoutId = $(this).data('workout-id');

        $.ajax({
            url: 'get_workout_exercise_id.php',
            method: 'POST',
            data: { exercise_id: exerciseId, workout_id: workoutId },
            success: function(response) {

                var workoutExerciseId = response;
                //alert('Cvik byl úspěšně přidán.');
                window.location.href = '/Trenio/admin/add_series.php?workout_exercise_id=' + workoutExerciseId;
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});