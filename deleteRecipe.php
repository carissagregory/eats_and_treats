<?php
    session_start();

    if ($_SESSION['logInSession'] !== "yes") {
        header("Location: login.php");
    }  
/*
    check session variable
    get recipe passed in the url
    connect to database
    delete recipe that was selected
    if recipe deletes successfully redirect to displayRecipes.php
    else redirect to errorMessage.html page
*/
    $recipeId = $_GET["recipeId"];
    //echo "recipeId passed from displayRecipes.php " . $recipeId;

    try{
        require 'dbConnect.php';
    
        $sql = "DELETE FROM eats_and_treats_recipes WHERE recipeId = :recipeId";
        
        $stmt = $conn->prepare($sql);
    
        //Bind Parameters
        $stmt->bindParam(":recipeId", $recipeId);
    
        $stmt->execute();       //Execute the PDO Prepared statement, save the results in $stmt object
    
        $stmt->setFetchMode(PDO::FETCH_ASSOC);       //return values as an associative array
    
    }
    catch(PDOException $e) {
        header("Location: errorMessage.html");
    }
    
    //return to selectEvents.php to display the updated list of events
    header("Location: displayRecipes.php");
?>