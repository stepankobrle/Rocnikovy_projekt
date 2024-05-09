<?php

class Workout{

    public static function createWorkout($connection, $name, $description, $users_id){
        $sql = "insert into workouts ( name, description, users_id) values 
        (:name, :description, :users_id)";

        $statement = $connection->prepare($sql);


            $statement->bindValue(":name", $name, PDO::PARAM_STR);
            $statement->bindValue(":description", $description, PDO::PARAM_STR);
            $statement->bindValue(":users_id", $users_id, PDO::PARAM_INT);

            try {
                if ($statement->execute()) {

                } else {
                    throw new Exception("Chyba při vytváření tréninku");
                }
            }catch (Exception $e){
                error_log("Chyba při vytváření tréninku createWorkout\n", 3, "../errors/error.log");
                echo "Typ chyby: " . $e->getMessage();

            }
        }




    public static function getAllWorkout($connection){
        $sql = "select * from workouts";
        $statement = $connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }


    public static function getAllWorkout_exersice($connection){
        $sql = "select * from workout_exercise";
        $statement = $connection->prepare($sql);

        try {
            if ($statement->execute()) {
                return $statement->fetchAll();
            } else {
                throw new Exception("Chyba při získávání cviků");
            }
        } catch(Exception $e){
            error_log("Chyba při získávání cviků getAllWorkout_exersice\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function getWorkoutById($connection, $workout_id){
        $sql = "select * from workouts where workout_id = :workout_id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":workout_id", $workout_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                return $statement->fetch();
            } else {
                throw new Exception("Chyba při získávání tréninku");
            }
        } catch(Exception $e){
            error_log("Chyba při získávání tréninku getWorkoutById\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function getExerciseByWorkoutId($connection, $workout_id){
        $sql = "SELECT e.*
                FROM exercises e
                INNER JOIN workout_exercise we ON e.exercise_id = we.exercise_id
                WHERE we.workout_id = :workout_id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":workout_id", $workout_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                return $statement->fetchAll();
            } else {
                throw new Exception("Chyba při získávání cviků");
            }
        } catch(Exception $e){
            error_log("Chyba při získávání cviků getExerciseByWorkoutId\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function getWorkoutByUserId($connection, $users_id) {

    }

    public static function deleteWorkout($connection, $id){
        $sql = "delete from workouts where workout_id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function updateWorkout($connection, $id, $name, $description){
        $sql = "update workouts set name = :name, description = :description where workout_id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $statement->bindValue(":name", $name, PDO::PARAM_STR);
        $statement->bindValue(":description", $description, PDO::PARAM_STR);
        $statement->execute();
    }


    public static function getWorkoutIdByWorkoutExercise($connection, $workout_exercise_id)
    {
        $sql = "SELECT workout_id FROM workout_exercise WHERE workout_exercise_id = :workout_exercise_id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':workout_exercise_id', $workout_exercise_id, PDO::PARAM_INT);

        try {
            if ($statement->execute()) {
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result['workout_id'];
            } else {
                throw new Exception("Chyba při získávání workout_id z workout_exercise");
            }
        } catch (Exception $e) {
            error_log("Chyba při získávání workout_id z workout_exercise\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }

    }


public static function removeExerciseFromWorkout($connection, $workout_id, $exercise_id)
{
    $deleteSeriesQuery = "DELETE FROM series 
                        WHERE workout_exercise_id IN (
                          SELECT workout_exercise_id 
                          FROM workout_exercise 
                          WHERE workout_id = :workout_id AND exercise_id = :exercise_id
                      )";


// Spuštění dotazu pro odstranění série
    $deleteSeriesStatement = $connection->prepare($deleteSeriesQuery);

    $deleteSeriesStatement->bindParam(':workout_id', $workout_id, PDO::PARAM_INT);
    $deleteSeriesStatement->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);

    try {
        $deleteSeriesStatement->execute(['workout_id' => $workout_id, 'exercise_id' => $exercise_id]);
    } catch (Exception $e) {
        error_log("Chyba při odstraňování série\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();

    }


// SQL dotaz pro odstranění cviku z tréninku
    $deleteExerciseQuery = "DELETE FROM workout_exercise 
                            WHERE workout_id = :workout_id AND exercise_id = :exercise_id";



// Spuštění dotazu pro odstranění cviku z tréninku
    $deleteExerciseStatement = $connection->prepare($deleteExerciseQuery);

    $deleteExerciseStatement->bindParam(':workout_id', $workout_id, PDO::PARAM_INT);
    $deleteExerciseStatement->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);

    try {
        $deleteExerciseStatement->execute();
    } catch (Exception $e) {
        error_log("Chyba při odstraňování cviku z tréninku\n", 3, "../errors/error.log");
        echo "Typ chyby: " . $e->getMessage();
    }
}


}

