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

?>