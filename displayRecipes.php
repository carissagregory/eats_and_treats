<?php
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
                while($eventRow = $stmt->fetch()){
                    echo "<div class='recipes'>";
                    echo "<h2> Recipe " . $eventRow["recipeId"] . "</h2>";
                    echo "<h3> Name: </h3>";
                    echo "<p>" . $eventRow["recipeName"] . "</p>";
                    echo "<p>" . $eventRow["recipeAuthor"] . "</p>";
                    echo "<p>" . $eventRow["recipeNumServings"] . " " . $eventRow["recipeServingKind"] . "</p>";
                    echo "<p>" . $eventRow["recipeCookingTime"] . " minutes</p>";
                    echo "<p>" . $eventRow["recipeDifficulty"] . "</p>";
                    echo "<p>" . $eventRow["recipeCategory"] . "</p>";
                    echo "<p>" . $eventRow["recipeDescription"] . "</p>";

                    $measurements = json_decode($eventRow["recipeMeasurements"]);
                    echo "<ul>";
                    foreach($measurements as $measurement) {
                        echo "<li>" . htmlspecialchars($measurement) . "</li>";
                    }
                    echo "</ul>";

                    $volumes = json_decode($eventRow["recipeVolumes"]);
                    echo "<ul>";
                    foreach($volumes as $volume) {
                        echo "<li>" . htmlspecialchars($volume) . "</li>";
                    }
                    echo "</ul>";

                    $types = json_decode($eventRow["recipeTypes"]);
                    echo "<ul>";
                    foreach($types as $type) {
                        echo "<li>" . htmlspecialchars($type) . "</li>";
                    }
                    echo "</ul>";

                    $directions = json_decode($eventRow["recipeDirections"]);
                    echo "<ol>";
                    foreach($directions as $direction) {
                        echo "<li>" . htmlspecialchars($direction) . "</li>";
                    }
                    echo "</ol>";

                    echo "<p>" . $eventRow["recipeImageName"] . "</p>";
                    echo "<p>" . $eventRow["recipeImage"] . "</p>";
                    echo "<button> <a href='updateEvent.php?eventsID=" . $eventRow["events_id"] . "'> <h4> Update </h4> </a> </button>";
                    echo "<button onclick='confirmDelete(" . $eventRow['events_id'] . ")'> <h4> Delete </h4> </button>";
                    echo "</div>";
                }
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