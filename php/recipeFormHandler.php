<?php
    //create recipe class and require file
    //use the setter function to set the variables from the form fields
    //get all form values for hard coded and dynamically created fields and set to arrays
    //  push values for measurement, volume, type, and direction fields into created arrays
    //  convert arrays into JSON format before insert into database
    //  define path for recipe image
    //Connect to database and insert recipeObject
        //1. Connect to the database
        //2. Create your SQL query
        //3. Prepare your PDO Statement
        //4. Bind Variables to the PDO Statement, if any
        //5. Execute the PDO Statement - Run your SQL against the database
        //6. Process the results back to the client

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

    $hostImageFolder = "images/uploadedImages/";
    basename($_FILES["inRecipeImage"]["name"]);

    $hostImagePath = $hostImageFolder . basename($_FILES["inRecipeImage"]["name"]);

    //echo "<h3>$hostImagePath</h3>";
     
    if (move_uploaded_file($_FILES["inRecipeImage"]["tmp_name"], $hostImagePath)) {
        echo "File uploaded successfully!";
    } else {
        echo "Failed to upload the file.";
    }
    
    $recipeObject->setDirectionArray($recipeDirections);
    $recipeObject->setMeasurementArray($recipeMeasurements);
    $recipeObject->setRecipeName($_POST['recipeName']);
    $recipeObject->setRecipeAuthor($_POST['recipeAuthor']);
    $recipeObject->setRecipeCategory($_POST['recipeCategory']);
    $recipeObject->setRecipeCookingTime($_POST['recipeCookingTime']);
    $recipeObject->setRecipeDescription($_POST['recipeDescription']);
    $recipeObject->setRecipeDifficulty($_POST['recipeDifficultyLevel']);
    $recipeObject->setRecipeImage($hostImagePath);
    $recipeObject->setRecipeImageName($_POST['inRecipeImageName']);
    $recipeObject->setRecipeNumServings($_POST['recipeNumServings']);
    $recipeObject->setRecipeServingKind($_POST['recipeServingKind']);
    $recipeObject->setTypeArray($recipeTypes);
    $recipeObject->setVolumeArray($recipeVolumes);

    try {
        require '../dbConnect.php';

        $sql = "INSERT INTO eats_and_treats_recipes (
            recipeAuthor,
            recipeCategory,
            recipeCookingTime,
            recipeDescription,
            recipeDifficulty,
            recipeDirections,
            recipeImage,
            recipeImageName,  
            recipeMeasurements, 
            recipeName,
            recipeNumServings,
            recipeServingKind,
            recipeTypes,
            recipeVolumes
            ) 
        VALUES (
            :recipeAuthor,
            :recipeCategory,
            :recipeCookingTime,
            :recipeDescription,
            :recipeDifficulty,
            :recipeDirections,
            :recipeImage,
            :recipeImageName,  
            :recipeMeasurements, 
            :recipeName,
            :recipeNumServings,   
            :recipeServingKind,         
            :recipeTypes,
            :recipeVolumes
            )";    //named parameter

        $stmt = $conn->prepare($sql);   //prepared statement PDO

        //put into alphabetical order
        $recipeDirections = $recipeObject->getDirectionArray();
        $recipeDirectionsJSON = json_encode($recipeDirections);

        $recipeImage = $recipeObject->getRecipeImage();
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

        //Bind Parameters
        $stmt->bindParam(":recipeAuthor", $recipeAuthor);
        $stmt->bindParam(":recipeCategory", $recipeCategory);
        $stmt->bindParam(":recipeCookingTime", $recipeCookingTime);
        $stmt->bindParam(":recipeDescription", $recipeDescription);
        $stmt->bindParam(":recipeDifficulty", $recipeDifficulty);
        $stmt->bindParam(":recipeDirections", $recipeDirectionsJSON);
        $stmt->bindParam(":recipeImage", $recipeImage);
        $stmt->bindParam(":recipeImageName", $recipeImageName);
        $stmt->bindParam(":recipeMeasurements", $recipeMeasurementsJSON);
        $stmt->bindParam(":recipeName", $recipeName);
        $stmt->bindParam(":recipeNumServings", $recipeNumServings);
        $stmt->bindParam(":recipeTypes", $recipeTypesJSON);
        $stmt->bindParam(":recipeServingKind", $recipeServingKind);
        $stmt->bindParam(":recipeVolumes", $recipeVolumesJSON);


        $stmt->execute();       //Execute the PDO Prepared statement, save the results in $stmt object

        $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            }
            catch(PDOException $e) {
                //change this to send to a php error_log
                echo "Database Failed: " . $e->getMessage();
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--css-->
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <!--headings font-->
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <!--regular text font-->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <!--logo-->
    <link rel="icon" href="../images/eatsAndTreatsLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Recipe Confirmation</title>
</head>
    <body class="container">
    <div class="navigationBar">
        <img src="../images/eatsAndTreatsLogo.png" alt="eats and treats logo">
    </div><!--navigationBar--> 
    <main class="confirmationContainer">
        <div id="submitRecipeConfirmation">
            <h1>Thank you for submitting a recipe!</h1>
            <p>
                Your recipe should appear on the site shortly. 
                If your recipe has not shown up within 24 hours please let us know by submitting our contact form.
            </p>
            <a href="../index.html"><button><h4>Home Page</h4></button></a>
        </div>
    </main>
    <footer>
        <p>Eats and Treats Copyright &copy <?php echo date("Y");?> </p>        
    </footer>
</body>
</html>