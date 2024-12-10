<?php
    session_start();

    if ($_SESSION['logInSession'] !== "yes") {
        header("Location: login.php");
    }  
//connect to database
//get values from database
//display formatted values for each recipe
//create delete and update buttons
//add delete and update functionality for recipes
    try{
        require 'dbConnect.php';

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

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        echo "Database Failed: " . $e->getMessage();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--external js file-->
    <script defer src="js/deleteRecipe.js"></script>
    <!--headings font-->
    <link href="https://fonts.googleapis.com/css2?family=Mate+SC&display=swap" rel="stylesheet">
    <!--regular text font-->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <!--css-->
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <!--logo-->
    <link rel="icon" href="images/eatsAndTreatsLogo.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Recipes">
    <meta name="descripton" content="Display Recipes page"> 
    <title>Display Recipes</title>
</head>
<body class="container">
    <div class="navigationBar">
        <nav>
            <ul>
                <li><a href="login.php">Admin</a></li>
                <li><a href="logout.php"><button class="logoutButton"><h4>Log Out</h4></button></a></li>
            </ul>
        </nav>
    </div><!--navigationBar-->  
    <main id="displayRecipes">
                <!--
                    Creating alt way of displaying data instead of as a table
                        use recipeId column to display recipe number
                        Add styling
                        decode json objects and display array as a list
                    Add delete confirmation js functionality to eatsAndTreatsJS.js
                    Add eventId variable and add column to sql statement
                    Add delete and update php
                -->
                <h1>All Recipes</h1>
                <?php
                echo "<div class='recipes'>";
                while($recipeRow = $stmt->fetch()){
                    echo "<div id='singleRecipe" . $recipeRow["recipeId"] . "'>";
                    echo "<h2> Recipe " . $recipeRow["recipeId"] . "</h2>";
                    echo "<h3>" . $recipeRow["recipeName"] . "</h3>";
                    echo "<h3>" . $recipeRow["recipeAuthor"] . "</h3>";
                    echo "<h3>" . $recipeRow["recipeNumServings"] . " " . $recipeRow["recipeServingKind"] . "</h3>";
                    echo "<h3>" . $recipeRow["recipeCookingTime"] . " minutes</h3>";
                    echo "<h3>" . $recipeRow["recipeDifficulty"] . "</h3>";
                    echo "<h3>" . $recipeRow["recipeCategory"] . "</h3>";
                    echo "<p> <img src='". $recipeRow["recipeImage"] ."' alt='" . $recipeRow["recipeImageName"] . " Image' class='recipeImage'> </p>";                    
                    echo "<p>" . $recipeRow["recipeDescription"] . "</p>";

                    $measurements = json_decode($recipeRow["recipeMeasurements"]);
                    $volumes = json_decode($recipeRow["recipeVolumes"]);
                    $types = json_decode($recipeRow["recipeTypes"]);

                    echo "<h2>Ingredients: </h2>";
                    echo "<ul>";
                    for ($x = 0; $x < count($measurements); $x++) {
                        echo "<li>";
                        echo htmlspecialchars($measurements[$x]) . " " .
                             htmlspecialchars($volumes[$x]) . " " .
                             htmlspecialchars($types[$x]);
                        echo "</li>";
                    }
                    echo "</ul>";

                    $directions = json_decode($recipeRow["recipeDirections"]);
                    echo "<h2>Directions: </h2>";
                    echo "<ol>";
                    foreach($directions as $direction) {
                        echo "<li>" . htmlspecialchars($direction) . "</li>";
                    }
                    echo "</ol>";

                    echo "<p id='recipeButtons'>";
                    echo "<button> <a href='updateEvent.php?eventsID=" . $recipeRow["recipeId"] . "'> <h4> Update </h4> </a> </button>";
                    echo "<button onclick='deleteRecipeConfirmation(" . $recipeRow['recipeId'] . ")'> <h4> Delete </h4> </button>";
                    echo "</p><!--recipeButton close-->";

                    echo "</div><!--singleRecipe close-->";
                }
                echo "</div><!--recipes close-->";
            ?>
    </main>
    <footer>
        <div class="footerNav">
            <ul>
                <li><a href="login.php">Admin</a></li>
                <li><a href="logout.php"><button class="logoutButton"><h4>Log Out</h4></button></a></li>
            </ul>    
        </div><!--footerNav-->    
            <p>Eats and Treats Copyright &copy <?php echo date("Y");?></p>
    </footer>
</body>
</html>