<?php
    session_start();

    if ($_SESSION['logInSession'] !== "yes") {
        header("Location: login.php");
    }  
    /*
        check session variable
        get recipeId passed in the url
        connect to the database
        display a form fields with current information about the recipe from the database
            check length of measurements array and display amount of ingredient fields based on how many values are in array
            check length of directions array and display amount of direction fields based on how many values are in array
            use js to create dynamically form fields create more ingredient and direction fields upon button click and check validation of form fields 
        after validation submit form and input form values into the database
        display confirmation message(alert)
        redirect to displayRecipes.php
            
    */

    $recipeId = $_GET["recipeId"];
    //echo "recipeId passed from displayRecipes.php " . $recipeId;


    $recipeName = $_POST['recipeName'];

    try{
        require 'dbConnect.php';

        $sql = "SELECT 
                recipeAuthor,
                recipeCategory,
                recipeCookingTime,
                recipeDescription,
                recipeDifficulty,
                recipeDirections,
                recipeImageName,  
                recipeMeasurements, 
                recipeName,
                recipeNumServings,
                recipeServingKind,
                recipeTypes,
                recipeVolumes
            FROM eats_and_treats_recipes WHERE recipeId = :recipeId";
        
        $stmt = $conn->prepare($sql);
    
        //Bind Parameters
        $stmt->bindParam(":recipeId", $recipeId);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $recipeRow = $stmt->fetch();

        //get recipe information
        $recipeAuthor = $recipeRow['recipeAuthor'];
        $recipeCategory = $recipeRow['recipeCategory'];
        $recipeCookingTime = $recipeRow['recipeCookingTime'];
        $recipeDescription = $recipeRow['recipeDescription'];
        $recipeDifficulty = $recipeRow['recipeDifficulty'];
        $recipeName = $recipeRow['recipeName'];
        $recipeNumServings = $recipeRow['recipeNumServings'];
        $recipeServingKind = $recipeRow['recipeServingKind'];

        // Decode JSON fields into arrays
        $recipeDirections = json_decode($recipeRow['recipeDirections']);
        $recipeMeasurements = json_decode($recipeRow['recipeMeasurements']);
        $recipeTypes = json_decode($recipeRow['recipeTypes']);
        $recipeVolumes = json_decode($recipeRow['recipeVolumes']);
        $recipeImageName = $recipeRow['recipeImageName'];

    }
    catch(PDOException $e) {
        echo "Database Failed: " . $e->getMessage();
        //header("Location: errorMessage.html");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--external js file-->
    <script defer src="js/recipeForm.js"></script>
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
    <title>Update Recipe</title>
    <script>
        function pageSetUp() {
            let recipeImageBtn = document.querySelector("#inRecipeImage");
            recipeImageBtn.addEventListener("click", function() {
                 alert("Recipe Image cannot be modified");
            });
        }
    </script>
</head>
<body class="container" onload="pageSetUp()">
        <div class="navigationBar">
            <img src="images/eatsAndTreatsLogo.png" alt="eats and treats logo">
            <nav>
                <ul>
                    <li><a href="login.php">Admin</a></li>
                    <li><a href="logout.php"><button class="logoutButton"><h4>Log Out</h4></button></a></li>
                </ul>
            </nav>
        </div><!--navigationBar-->  
        <main id="updateRecipePage">
            <form id="submitRecipeForm" name="submitRecipeForm" method="post" action="php/processUpdateRecipe.php" enctype="multipart/form-data">
                <legend>Upload a Recipe</legend>
                <p>
                    <input type="hidden" name="recipeId" value="<?php echo $recipeId ?>">
                </p>
                <p>
                    <label for="recipeName">Recipe Name:</label> 
                    <br>
                    <input type="text" name="recipeName" id="recipeName" placeholder="Chocolate Chip Cookies" value="<?php echo $recipeName; ?>">
                    <br>
                    <span id="nameError"></span>  
                </p><!--recipeName close-->
                <p>
                    <label for="recipeAuthor">Recipe Author:</label> 
                    <br>
                    <input type="text" name="recipeAuthor" id="recipeAuthor" placeholder="Eats and Treats" value="<?php echo $recipeAuthor; ?>">
                    <br>
                    <span id="authorError"></span>  
                </p><!--recipeAuthor close-->
                <p>
                    <label for="recipeNumServings">Number of Servings:</label>
                    <label for="recipeServingKind">Type of Serving:</label>
                    <br>
                    <input type="number" name="recipeNumServings" id="recipeNumServings" placeholder="3, 24" value="<?php echo $recipeNumServings; ?>">
                    <!--Could do dropdown for serving type(servings, cookies, cupcakes, cakes)-->
                    <input type="text" name="recipeServingKind" id="recipeServingKind" placeholder="People, Cookies" value="<?php echo $recipeServingKind; ?>">
                    <br>
                    <span id="numServingsError"></span>  
                    <br>
                    <span id="servingKindError"></span>  
                </p><!--recipeServings close-->
                <p>
                    <label for="recipeCookingTime">Cooking Time(in minutes):</label>
                    <br>
                    <input type="number" name="recipeCookingTime" id="recipeCookingTime" placeholder="30, 90" value="<?php echo $recipeCookingTime; ?>">
                    <br>
                    <span id="cookingTimeError"></span>  
                </p><!--recipeCookingTime close-->         
                <p>
                    <label for="recipeDifficultyLevel">Difficulty:</label>
                    <br>
                    <select name="recipeDifficultyLevel" id="recipeDifficultyLevel">
                        <option value="">Select a difficulty</option>
                        <option value="easy" <?php echo ($recipeDifficulty === 'easy') ? 'selected' : ''; ?>>Easy</option>
                        <option value="moderate" <?php echo ($recipeDifficulty === 'moderate') ? 'selected' : ''; ?>>Moderate</option>
                        <option value="hard" <?php echo ($recipeDifficulty === 'hard') ? 'selected' : ''; ?>>Hard</option>
                    </select>
                    <br>
                    <span id="difficultyError"></span>  
                </p><!--recipeDifficultyLevel close-->       
                <h4>Recipe Category:</h4>
                <p>
                    <label for="breakfastCategory">Breakfast</label> 
                    <input type="radio" name="recipeCategory" id="breakfastCategory" value="breakfast" <?php echo ($recipeCategory === 'breakfast') ? 'checked' : ''; ?> >
                    <label for="entreeCategory">Entrée</label> 
                    <input type="radio" name="recipeCategory" id="entreeCategory" value="entree" <?php echo ($recipeCategory === 'entree') ? 'checked' : ''; ?> >
                    <label for="dessertCategory">Dessert</label> 
                    <input type="radio" name="recipeCategory" id="dessertCategory" value="dessert" <?php echo ($recipeCategory === 'dessert') ? 'checked' : ''; ?> >
                    <br>
                    <span id="categoryError"></span>  
                </p><!--recipeCategory close-->
                <p>
                    <label for="recipeDescription">Recipe Description:</label>
                    <br>
                    <input type="text" name="recipeDescription" id="recipeDescription" placeholder="1-2 sentence description of the recipe" value="<?php echo $recipeDescription ?>">
                    <br>
                    <span id="descriptionError"></span>  
                </p><!--recipeDescription close-->
                <section id="ingredientsFields">
                    <h4>Ingredients:</h4>
                    <?php
                        for ($m = 0; $m < count($recipeMeasurements); $m++) {
                            echo '<p>';
                            echo '<label for="ingredient' . ($m + 1) .'Measurement">Measurement:</label>';
                            echo '<label for="ingredient' . ($m + 1) .'Volume">Volume:</label>';
                            echo '<br>';
                            echo '<input type="number" name="ingredient' . ($m + 1) . 'Measurement" id="ingredient' . ($m + 1) . 'Measurement" value="' . $recipeMeasurements[$m] . '">';
                            echo '<select name="ingredient' . ($m + 1) . 'Volume" id="ingredient' . ($m + 1) . 'Volume">';
                            $volumes = ["tsp", "tbsp", "cups", "pt", "qt", "gal", "oz", "flOz", "lb", "clove", "box", "can", "small", "medium", "large", "stick"];
                            foreach ($volumes as $volume) {
                                $selectedVolume = ($recipeVolumes[$m] === $volume) ? ' selectedVolume' : '';
                                echo '<option value="' . $volume . '"' . $selectedVolume . '>' . $volume . '</option>';
                            }
                            echo '</select>';
                            echo '<br>';
                            echo '<label for="ingredient' . ($m + 1) .'Type">Type: </label>';
                            echo '<br>';
                            echo '<input type="text" name="ingredient' . ($m + 1) . 'Type" id="ingredient' . ($m + 1) . 'Type" value="' . $recipeTypes[$m] . '">';
                            echo '</p>';
                        }
                    ?>
                    <template id="ingredientTemplate">
                        <p>
                            <label for="ingredient1Measurement">Measurement:</label>
                            <label for="ingredient1Volume">Volume:</label>
                            <br>
                            <input type="number" name="ingredient1Measurement" id="ingredient1Measurement" placeholder="0.5, 1">
                            <select name="ingredient1Volume" id="ingredient1Volume">  
                                <option value="">Select an volume</option>
                                <option value="tsp">tsp</option>
                                <option value="tbsp">tbsp</option>
                                <option value="cups">cups</option>
                                <option value="pt">pt</option>
                                <option value="qt">qt</option>
                                <option value="gal">gal</option>
                                <option value="oz">oz</option>
                                <option value="flOz">fl oz</option>
                                <option value="lb">lb</option>
                                <option value="clove">clove</option>
                                <option value="box">box</option>
                                <option value="can">can</option>
                                <option value="small">small</option>
                                <option value="medium">medium</option>
                                <option value="large">large</option>
                            </select>                    
                            <br>
                            <label for="ingredient1Type">Ingredient Type:</label>
                            <br>                      
                            <input type="text" name="ingredient1Type" id="ingredient1Type" placeholder="flour , vanilla extract">
                    </template>
                </section><!--ingredientFields close-->
                <p>
                    <span id="ingredientError"></span>
                    <br>
                    <input type="button" name="addIngredientButton" id="addIngredientButton" value="Add Ingredient Field" onclick="addIngredientFields()">
                </p><!--addIngredientButton close-->
                <section id="directionsFields">
                    <h4>Directions:</h4>
                    <?php
                        foreach ($recipeDirections as $index => $direction) {
                            echo '<p>';
                            echo '<label for="direction' . ($index + 1) . '">' . ($index + 1) . '.</label>';
                            echo '<textarea name="direction' . ($index + 1) . '" id="direction' . ($index + 1) . '" rows="2" cols="50">' . $direction . '</textarea>';
                            echo '</p>';
                        }
                    ?>
                    <template id="directionTemplate">
                        <p>
                            <label for="direction1">1.</label>
                            <textarea name="direction1" id="direction1" rows="2" cols="50">
        
                            </textarea>                         
                        </p>
                    </template>
                </section><!--directionFields close-->
                <p>
                    <span id="directionError"></span> 
                    <br>
                    <input type="button" name="addDirectionButton" id="addDirectionButton" value="Add Direction Field" onclick="addDirectionField()">
                </p><!--addDirectionButton close-->
                <p>
                    <label for="inRecipeImageName">Image File Name(Name of Recipe): </label>
                    <br>
                    <input type="text" name="inRecipeImageName" id="inRecipeImageName" placeholder="recipe image name" value="<?php echo $recipeImageName; ?>">
                    <br>
                    <span id="imageNameError"></span>  
                    <br>
                    <label for="inRecipeImage">Select Your Recipe Image: </label>
                    <br>
                    <input type="button" name="inRecipeImage" id="inRecipeImage" value="Choose File">
                    <br>
                    <span id="imageError"></span>  
                </p><!--uploadRecipeImage close-->
                <p>
                    <input type="button" name="submitRecipe" id="submitRecipe" value="Submit" onclick="validateRecipeFormFields()">
                    <input type="reset" name="reset" id="reset" value="Reset">
                </p><!--form buttons close-->
            </form>
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