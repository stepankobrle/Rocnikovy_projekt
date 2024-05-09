<?php
class Exercise {

    public static function getExercise($connection, $exercise_id, $collumn = "*")
    {
        $sql = "SELECT $collumn
                FROM exercises  
                WHERE exercise_id = :exercise_id";

        // $stmt = mysqli_prepare($connection, $sql);
        $statement = $connection->prepare($sql);


            // mysqli_stmt_bind_param($stmt, "i", $id);
            $statement->bindValue(":exercise_id", $exercise_id, PDO::PARAM_INT);

            try{
                if ($statement->execute()) {
                    return $statement->fetch();
                }else{
                    throw new Exception("Chyba při získávání cviku");
                }
            } catch(Exception $e){
                error_log("Chyba při získávání cviku getExercise\n",3, "../errors/error.log");
                echo "Typ chyby: " . $e->getMessage();
            }
    }





    public static function updateExercise($connection, $name, $description, $exercise_id){

        $sql = "UPDATE exercises
                    SET name = :name,
                        description = :description
                    WHERE exercise_id = :exercise_id";

        $statement = $connection->prepare($sql);

            $statement->bindValue(":name", $name, PDO::PARAM_STR);
            $statement->bindValue(":description", $description, PDO::PARAM_STR);
            $statement->bindValue(":exercise_id", $exercise_id, PDO::PARAM_INT);

            try{
                if ($statement->execute()) {
                    return true;
                }else{
                    throw new Exception("Chyba při updatetovani cviku");
                }
            } catch(Exception $e){
                error_log("Chyba při updatetovani cviku updateExercise\n",3, "../errors/error.log");
                echo "Typ chyby: " . $e->getMessage();
            }

        }






    public static function deleteExercise($connection, $exercise_id)
    {
        $sql = "DELETE
                FROM exercises
                WHERE exercise_id = :exercise_id";

        // $stmt = mysqli_prepare($connection, $sql);
        $stmt = $connection->prepare($sql);


            // mysqli_stmt_bind_param($stmt, "i", $id);
            $stmt->bindValue(":exercise_id", $exercise_id, PDO::PARAM_INT);

            try{
                if ($stmt->execute()) {
                    return true;
                } else{
                    throw new Exception("Chyba při mazání cviku");
                }
            }catch(Exception $e){
                error_log("Chyba při mazání cviku deleteExercise\n",3, "../errors/error.log");
                echo "Typ chyby: " . $e->getMessage();
            }
    }



    public static function getAllExercise($pdo)
    {
        $stmt = $pdo->query('SELECT * FROM exercises');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        /*
                $sql = "SELECT $name
                        FROM exercises";

                // $result = mysqli_query($connection, $sql);
                $statement = $connection->prepare($sql);

                if($statement->execute()){
                    return $statement->fetchAll(PDO::FETCH_ASSOC);
                }

                // if ($result === false) {
                //     echo mysqli_error($connection);
                // } else {
                //     $allExercise = mysqli_fetch_all($result, MYSQLI_ASSOC);
                //     return $allStudents;
                // }
        */
    }



    public static function createExercise($connection, $name, $description, $image = null, $user_id = null)
    {

        $sql = "insert into exercises ( name, description, image, users_id) values 
        (:name, :description, :image, :users_id)";

        $statement = $connection->prepare($sql);


        //mysqli_stmt_bind_param($statement, "sss", $name,$description, $image);
        $statement->bindValue(":name", $name, PDO::PARAM_STR);
        $statement->bindValue(":description", $description, PDO::PARAM_STR);
        if ($image !== null) {
            $statement->bindValue(":image", $image, PDO::PARAM_STR);
        } else {
            $statement->bindValue(":image", null, PDO::PARAM_NULL);
        }
        if ($user_id !== null) {
            $statement->bindValue(":users_id", $user_id, PDO::PARAM_INT);
        } else {
            $statement->bindValue(":users_id", null, PDO::PARAM_NULL);
        }

        try {
            if ($statement->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("Chyba při vytváření cviku");
            }
        } catch (Exception $e) {
            error_log("Chyba při vytváření cviku createExercise\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }



    public static function getExerciseUseridWithoutUserid($connection, $logged_in_user_id){
        $sql = "SELECT * FROM exercises WHERE users_id IS NULL OR users_id = :logged_in_user_id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':logged_in_user_id', $logged_in_user_id, PDO::PARAM_INT);

        try {
            if($statement->execute()) {
                return $statement->fetchAll();
            } else {
                throw new Exception("Chyba při získávání cviku");
            }
        } catch (Exception $e) {
            error_log("Chyba při získávání cviku getExerciseUseridWithoutUserid\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }

        //$statement->execute();
        //$exercises = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}