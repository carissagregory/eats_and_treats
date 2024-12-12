<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

    session_start();

    if ($_SESSION['logInSession'] !== "yes") {
        header("Location: login.php");
    }
    
    $recipeId = $_POST["recipeId"];

    require "Recipe.php";

    $recipeObject = new Recipe();


    $recipeDirections = [];
    foreach ($_POST as $key => $value) {
        if (str_starts_with($key, 'direction')) {
            //echo '<p>',$value,'</p>';
            $removeDirectionSpacing = trim($value);
            array_push($recipeDirections, $removeDirectionSpacing);
        }
    }

    $recipeMeasurements = [];
    foreach ($_POST as $key => $value) {
        // Check if the key ends with "Measurement"
        if (str_ends_with($key, 'Measurement')) {
            //echo '<p>',$value,'</p>';
            array_push($recipeMeasurements, $value);
        }
    }

    $recipeTypes = [];
    foreach ($_POST as $key => $value) {
        if (str_ends_with($key, 'Type')) {
            array_push($recipeTypes, $value);
        }
    }

    $recipeVolumes = [];
    foreach ($_POST as $key => $value) {
        if (str_ends_with($key, 'Volume')) {
            array_push($recipeVolumes, $value);
        }
    }

    //print_r($recipeMeasurements);
    
    $recipeObject->setDirectionArray($recipeDirections);
    $recipeObject->setMeasurementArray($recipeMeasurements);
    $recipeObject->setRecipeName($_POST['recipeName']);
    $recipeObject->setRecipeAuthor($_POST['recipeAuthor']);
    $recipeObject->setRecipeCategory($_POST['recipeCategory']);
    $recipeObject->setRecipeCookingTime($_POST['recipeCookingTime']);
    $recipeObject->setRecipeDescription($_POST['recipeDescription']);
    $recipeObject->setRecipeDifficulty($_POST['recipeDifficultyLevel']);
    $recipeObject->setRecipeImageName($_POST['inRecipeImageName']);
    $recipeObject->setRecipeNumServings($_POST['recipeNumServings']);
    $recipeObject->setRecipeServingKind($_POST['recipeServingKind']);
    $recipeObject->setTypeArray($recipeTypes);
    $recipeObject->setVolumeArray($recipeVolumes);

    //print_r($recipeMeasurements);

    try {
        require '../dbConnect.php';

        $sql = "UPDATE eats_and_treats_recipes
        SET 
            recipeAuthor = :recipeAuthor,
            recipeCategory = :recipeCategory,
            recipeCookingTime = :recipeCookingTime,
            recipeDescription = :recipeDescription,
            recipeDifficulty = :recipeDifficulty,
            recipeDirections = :recipeDirections,
            recipeImageName = :recipeImageName,
            recipeMeasurements = :recipeMeasurements,
            recipeName = :recipeName,
            recipeNumServings = :recipeNumServings,
            recipeServingKind = :recipeServingKind,
            recipeTypes = :recipeTypes,
            recipeVolumes = :recipeVolumes
        WHERE recipeId = :recipeId";

        $stmt = $conn->prepare($sql);   //prepared statement PDO

        $recipeDirections = $recipeObject->getDirectionArray();
        $recipeDirectionsJSON = json_encode($recipeDirections);

        $recipeMeasurements = $recipeObject->getMeasurementArray();
        $recipeMeasurementsJSON = json_encode($recipeMeasurements);

        $recipeTypes = $recipeObject->getTypeArray();
        $recipeTypesJSON = json_encode($recipeTypes);

        $recipeVolumes = $recipeObject->getVolumeArray();
        $recipeVolumesJSON = json_encode($recipeVolumes);

        $recipeAuthor = $recipeObject->getRecipeAuthor();
        $recipeCategory = $recipeObject->getRecipeCategory();
        $recipeCookingTime = $recipeObject->getRecipeCookingTime();
        $recipeDescription = $recipeObject->getRecipeDescription();
        $recipeDifficulty = $recipeObject->getRecipeDifficulty();
        $recipeName = $recipeObject->getRecipeName();
        $recipeNumServings = $recipeObject->getRecipeNumServings();
        $recipeImageName = $recipeObject->getRecipeImageName();
        $recipeServingKind = $recipeObject->getRecipeServingKind();

        // Bind Parameters
        $stmt->bindParam(":recipeAuthor", $recipeAuthor);
        $stmt->bindParam(":recipeCategory", $recipeCategory);
        $stmt->bindParam(":recipeCookingTime", $recipeCookingTime);
        $stmt->bindParam(":recipeDescription", $recipeDescription);
        $stmt->bindParam(":recipeDifficulty", $recipeDifficulty);
        $stmt->bindParam(":recipeDirections", $recipeDirectionsJSON);
        $stmt->bindParam(":recipeImageName", $recipeImageName);
        $stmt->bindParam(":recipeMeasurements", $recipeMeasurementsJSON);
        $stmt->bindParam(":recipeName", $recipeName);
        $stmt->bindParam(":recipeNumServings", $recipeNumServings);
        $stmt->bindParam(":recipeServingKind", $recipeServingKind);
        $stmt->bindParam(":recipeTypes", $recipeTypesJSON);
        $stmt->bindParam(":recipeVolumes", $recipeVolumesJSON);

        $stmt->bindParam(":recipeId", $recipeId);
    
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    }
    catch(PDOException $e) {
        echo "Database Failed: " . $e->getMessage();
        //header("Location: errorMessage.html");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <title>Update Confirmation</title>
</head>
<body class="container">
    <div class="navigationBar">
        <img src="../images/eatsAndTreatsLogo.png" alt="eats and treats logo">
    </div><!--navigationBar--> 
    <main class="confirmationContainer">
        <div id="updateRecipeConfirmation">
            <h1>The recipe has been updated</h1>
            <a href="../displayRecipes.php"><button><h4>Display Recipes</h4></button></a>
        </div>
    </main>
    <footer>
        <p>Eats and Treats Copyright &copy <?php echo date("Y");?> </p>        
    </footer>
</body>
</html>