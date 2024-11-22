<?php
    
    //connect to the database
    //use insert to add recipes to the eats_and_treats_recipe table
    //once submit is clicked display confirmation message with button to the admin page
    //change js current year to php current year
    session_start();
    if (!isset($_SESSION['logInSession']) || $_SESSION['logInSession'] !== "yes"){
        //you are not a valid user and CANNOT access this page - return to login
        header("Location: login.php");    //server side redirect
    }
    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--external js file-->
    <script defer src="js/eatsAndTreatsJS.js"></script>
    <!--external php file-->
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
    <meta name="keywords" content="Add a Recipe, Recipes">
    <meta name="descripton" content="Add a Recipe Form">    
    <title>Add a Recipe</title>    
</head>
<body class="container">
        <div class="navigationBar">
            <img src="images/eatsAndTreatsLogo.png" alt="eats and treats logo">
            <nav>
                <ul>
                    <li><a href="login.php">Admin</a></li>
                    <a href="login.php"><button class="logoutButton"><h4>Log Out</h4></button></a>
                </ul>
            </nav>
        </div><!--navigationBar-->  
        <main id="addRecipePage">
            <form id="addRecipeForm" name="addRecipeForm" method="post" action="php/recipeFormHandler.php" enctype="multipart/form-data">
                <legend>Add a Recipe</legend>
                <p>
                    <label for="recipeName">Recipe Name:</label> 
                    <br>
                    <input type="text" name="recipeName" id="recipeName" placeholder="Chocolate Chip Cookies">
                </p><!--recipeName close-->
                <p>
                    <label for="recipeAuthor">Recipe Author:</label> 
                    <br>
                    <input type="text" name="recipeAuthor" id="recipeAuthor" placeholder="Eats and Treats">
                </p><!--recipeAuthor close-->
                <p>
                    <label for="recipeNumServings">Number of Servings:</label>
                    <label for="recipeServingType">Type of Serving:</label>
                    <br>
                    <input type="number" name="recipeNumServings" id="recipeNumServings" placeholder="3, 24">
                    <!--Could do dropdown for serving type(servings, cookies, cupcakes, cakes)-->
                    <input type="text" name="recipeServingType" id="recipeServingType" placeholder="People, Cookies">
                </p><!--recipeServings close-->
                <p>
                    <label for="recipeCookingTime">Cooking Time(in minutes):</label>
                    <br>
                    <input type="number" name="recipeCookingTime" id="recipeCookingTime" placeholder="30, 90">
                </p><!--recipeCookingTime close-->         
                <p>
                    <label for="recipeDifficultyLevel">Difficulty:</label>
                    <br>
                    <select name="recipeDifficultyLevel" id="recipeDifficultyLevel">
                        <option value="">Select a difficulty</option>
                        <option value="easy">Easy</option>
                        <option value="moderate">Moderate</option>
                        <option value="hard">Hard</option>
                    </select>  
                </p><!--recipeDifficultyLevel close-->       
                <h4>Recipe Category:</h4>
                <p>
                    <label for="breakfastCategory">Breakfast</label> 
                    <input type="radio" name="recipeCategory" id="breakfastCategory">
                    <label for="entreeCategory">Entrée</label> 
                    <input type="radio" name="recipeCategory" id="entreeCategory">
                    <label for="dessertCategory">Dessert</label> 
                    <input type="radio" name="recipeCategory" id="dessertCategory">
                </p><!--recipeCategory close-->
                <p>
                    <label for="recipeDescription">Recipe Description:</label>
                    <br>
                    <input type="text" name="recipeDescription" id="recipeDescription" placeholder="1-2 sentence description of the recipe">
                </p><!--recipeDescription close-->
                <section id="ingredientsFields">
                    <h4>Ingredients:</h4>
                    <!--Could do dropdown for volume-->
                    <p>
                        <label for="ingredient1Measurement">Measurement:</label>
                        <label for="ingredient1Volume">Volume:</label>
                        <br>
                        <input type="number" name="ingredient1Measurement" id="ingredient1Measurement" placeholder="0.5, 1">
                        <select name="ingredient1Volume" id="ingredient1Volume">  
                            <!--tsp, tbsp, cups, large, pt, qt, gal, oz, fl oz, lb-->
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
                            <option value="large">large</option>
                        </select>                    
                        <br>
                        <label for="ingredient1Type">Ingredient Type:</label>
                        <br>                      
                        <input type="text" name="ingredient1Type" id="ingredient1Type" placeholder="flour , vanilla extract">
                    </p>
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
                                <option value="large">large</option>
                            </select>                    
                            <br>
                            <label for="ingredient1Type">Ingredient Type:</label>
                            <br>                      
                            <input type="text" name="ingredient1Type" id="ingredient1Type" placeholder="flour , vanilla extract">
                    </template>
                </section><!--ingredientFields close-->
                <p>
                    <input type="button" name="addIngredientButton" id="addIngredientButton" value="Add Ingredient Field" onclick="addIngredientFields()">
                </p><!--addIngredientButton close-->
                <section id="directionsFields">
                    <h4>Directions:</h4>
                    <p>
                        <label for="direction1">1.</label>
                        <textarea name="direction1" id="direction1" rows="2" cols="50">

                        </textarea>
                    </p>
                    <template id="directionTemplate">
                        <p>
                            <label for="direction1">1.</label>
                            <textarea name="direction1" id="direction1" rows="2" cols="50">
        
                            </textarea>
                        </p>
                    </template>
                </section><!--directionFields close-->
                <p>
                    <input type="button" name="addDirectionButton" id="addDirectionButton" value="Add Direction Field" onclick="addDirectionField()">
                </p><!--addDirectionButton close-->
                <p>
                    <label for="inRecipeImageName">Image File Name(Name of Recipe): </label>
                    <br>
                    <input type="text" name="inRecipeImageName" id="inRecipeImageName" placeholder="recipe image name">
                    <br>
                    <label for="inRecipeImage">Select Your Recipe Image: </label>
                    <br>
                    <input type="file" name="inRecipeImage" id="inRecipeImage" accept=".jpg,.gif,.png,.svg">
                </p><!--uploadRecipeImage close-->
                <p>
                    <input type="button" name="submit" id="submit" value="Submit" onclick="validateRecipeFormFields()">
                    <input type="reset" name="reset" id="reset" value="Reset">
                </p>
            </form>
        </main>
        <footer>
            <div class="footerNav">
                <ul>
                    <li><a href="login.php">Admin</a></li>
                    <a href="login.php"><button class="logoutButton"><h4>Log Out</h4></button></a>
                </ul>    
            </div><!--footerNav-->    
                <p>Eats and Treats Copyright &copy <span class="copyrightYear">year</span></p>        
        </footer>
        <?php
            }
        ?>
</body>
</html>