<?php
    try{
        require '../dbConnect.php';

        $sql = "SELECT 
                    recipeId,
                    recipeName, 
                    recipeAuthor,
                    recipeNumServings,
                    recipeServingKind,
                    recipeCookingTime,
                    recipeDifficulty,
                    recipeCategory,
                    recipeDescription,
                    recipeMeasurements,
                    recipeVolumes,
                    recipeTypes,
                    recipeDirections,
                    recipeImageName,
                    recipeImage
                FROM eats_and_treats_recipes";
        
        $stmt = $conn->prepare($sql);

        //Bind Parameters - n/a

        $stmt->execute();

        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($recipes);

    }
    catch(PDOException $e) {
        echo "Database Failed: " . $e->getMessage();
    }
?>