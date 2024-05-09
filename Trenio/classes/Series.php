<?php
class Series
{
    public static function getSeries($connection,$series_id)
    {
        $sql = "SELECT * FROM series WHERE series_id = :series_id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':series_id', $series_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                return $statement->fetch();
            } else {
                throw new Exception("Chyba při získávání sérií");
            }
        } catch (Exception $e) {
            error_log("Chyba při získávání sérií\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }





    public static function updateSeries ($connection, $set_number, $repetitions, $weight, $series_id)
    {
        $sql = "UPDATE series
                    SET set_number = :set_number,
                        repetitions = :repetitions,
                        weight = :weight
                    WHERE series_id = :series_id";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':set_number', $set_number, PDO::PARAM_INT);
        $statement->bindParam(':repetitions', $repetitions, PDO::PARAM_STR);
        $statement->bindParam(':weight', $weight, PDO::PARAM_STR);
        $statement->bindParam(':series_id', $series_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                return true;
            } else {
                throw new Exception("Chyba při updatetování série");
            }
        } catch (Exception $e) {
            error_log("Chyba při updatetování série\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }




    public static function deleteSeries($connection,$series_id)
    {
        $sql = "DELETE FROM series WHERE series_id = :series_id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':series_id', $series_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {

            } else {
                throw new Exception("Chyba při mazání série");
            }
        } catch (Exception $e) {
            error_log("Chyba při mazání série\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function maxSetnumber($connection, $workout_exercise_id)
    {
        $sql = "SELECT MAX(set_number) AS max_setnumber FROM series WHERE workout_exercise_id = :workout_exercise_id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':workout_exercise_id', $workout_exercise_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $highest_setnumber = $result['max_setnumber'];
                return $highest_setnumber + 1;
            } else {
                throw new Exception("Chyba při získávání nejvyššího setnumberu");
            }
        } catch (Exception $e) {
            error_log("Chyba při získávání nejvyššího setnumberu\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function addSeries($connection,$workout_exercise_id, $new_setnumber, $reps, $weight)
    {
        $sql_insert = "INSERT INTO series (workout_exercise_id, set_number, repetitions,weight) VALUES (:workout_exercise_id, :set_number, :repetitions, :weight)";
        $statement = $connection->prepare($sql_insert);
        $statement->bindParam(':workout_exercise_id', $workout_exercise_id, PDO::PARAM_INT);
        $statement->bindParam(':set_number', $new_setnumber, PDO::PARAM_INT);
        $statement->bindParam(':repetitions', $reps, PDO::PARAM_STR);
        $statement->bindParam(':weight', $weight, PDO::PARAM_STR);

        try {
            if ($statement->execute()) {
               // Url::redirectUrl("/admin/one_workout.php?id=" . $workout_exercise_id);
            } else {
                throw new Exception("Chyba při vkládání dat do databáze");
            }
        } catch (Exception $e) {
            error_log("Chyba při vkládání dat do databáze\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }



    public static function seriesByExercise ($connection, $exercise_id, $workout_id)
    {
        $sql = "SELECT s.*
        FROM series s
        JOIN workout_exercise we ON s.workout_exercise_id = we.workout_exercise_id
        JOIN exercises e ON we.exercise_id = e.exercise_id
        WHERE e.exercise_id = :exercise_id AND we.workout_id = :workout_id";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
        $statement->bindParam(':workout_id', $workout_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                return $statement->fetchAll();
            } else {
                throw new Exception("Chyba při získávání sérií");
            }
        } catch (Exception $e) {
            error_log("Chyba při získávání sérií\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }

}