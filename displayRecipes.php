<?php
//connect to database
//get values from database
//display formatted values for each recipe
//create delete and update buttons
//add delete and update functionality for recipes
    try{
        require 'dbConnect.php';

        $sql = "SELECT 
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
    <script defer src="js/eatsAndTreatsJS.js"></script>
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
        <div id="recipeRecords">
            <div>
                <!--
                    Creating alt way of displaying data instead of as a table
                        In recipeNumber section use js to update record number 
                        Add styling
                    Add delete confirmation js functionality to eatsAndTreatsJS.js
                    Add eventId variable and add column to sql statement
                    Add delete and update php

                -->
                <h2>Recipe </h2>
                <p>RecipeName</p>
                <?php
                while($eventRow = $stmt->fetch()){
                    echo "<div class='recipes'>";
                    echo "Recipe <section class='recipeNumber'></section>";
                    echo "<h3> Name: </h3>";
                    echo "<p>" . $eventRow["recipeName"] . "</p>";
                    echo "<p>" . $eventRow["recipeAuthor"] . "</p>";
                    echo "<p>" . $eventRow["recipeNumServings"] . "</p>";
                    echo "<p>" . $eventRow["recipeServingKind"] . "</p>";
                    echo "<p>" . $eventRow["recipeCookingTime"] . "</p>";
                    echo "<p>" . $eventRow["recipeDifficulty"] . "</p>";
                    echo "<p>" . $eventRow["recipeCategory"] . "</p>";
                    echo "<p>" . $eventRow["recipeDescription"] . "</p>";
                    echo "<p>" . $eventRow["recipeMeasurements"] . "</p>";
                    echo "<p>" . $eventRow["recipeVolumes"] . "</p>";
                    echo "<p>" . $eventRow["recipeTypes"] . "</p>";
                    echo "<p>" . $eventRow["recipeDirections"] . "</p>";
                    echo "<p>" . $eventRow["recipeImageName"] . "</p>";
                    echo "<p>" . $eventRow["recipeImage"] . "</p>";
                    echo "<section class='modifyButtons>";
                    echo "<button> <a href='updateEvent.php?eventsID=" . $eventRow["events_id"] . "'> Update </a> </button>";
                    echo "<button onclick='confirmDelete(" . $eventRow['events_id'] . ")'> Delete</button>";
                    echo "</section>";
                    echo "</div>";
                }
            ?>
            </div>
        </div>
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