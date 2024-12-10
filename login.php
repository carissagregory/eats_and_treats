<?php
    session_start();

    if ($_SESSION['logInSession'] === "yes") {
        //if the logInSession is valid then the user can acces the admin page not the login page again
        $validLogIn = true;  //set flag for validLogIn to display the Admin Page
    }
    else {
        if (isset($_POST['submit'])) {
            //Did the user SUBMIT the form to sign on?  Yes
            //the form was submitted continue processing the form data
            /*
                -get the data from the form
                -connect to the database
                see if you have a matching record in the users table
                if (match = true) {
                    valid user
                    display the admin page
                }
                else {
                    invalid user
                    display error message
                    display the form
                }
            */

            $inUsername = $_POST['inUsername'];
            $inPassword = $_POST['inPassword']; 

            try{
                require 'dbConnect.php';        //access to the database 
                
                //does the input username AND password MATCH the username AND password in the datebase?
                $sql = "SELECT COUNT(*) FROM eats_and_treats_users WHERE user_username = :username AND user_password = :password";
        
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bindParam(":username", $inUsername);
                $stmt->bindParam(":password", $inPassword);
            
                $stmt->execute();
                
                // Fetch the count
                $rowCount = $stmt->fetchColumn();       //get number of rows in result set/statement

                if ($rowCount > 0) {
                    //valid username/passwod
                    $validLogIn = true;          //switch aka flag
                    $_SESSION['logInSession'] = "yes";  //valid log in- allow access to the admin page
                } else {
                    //invalid
                    $validLogIn = false;
                    $errorMessage = "<p id='errorMessage'>Invalid username/password, please try again.</p>";
                    $_SESSION['LogInSession'] = "no";       //invalid log in - do NOT allow access
                }
                
                $stmt->setFetchMode(PDO::FETCH_ASSOC);       //return values as an associative array
            }
            catch(PDOException $e) {
                echo "Database Failed: " . $e->getMessage();
            }
        }
        else {
            //the customer needs to see the form in order to fill it out and SUBMIT it for signin
        }
    }//end of check for 'validSession'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--external js file-->

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
    <meta name="keywords" content="">
    <meta name="descripton" content="Log In page">    
    <title>Log In Page</title>
</head>
<body class="container">
    <?php
        if (isset($_POST['submit']) || $validLogIn === true) {
            //display admin features
    ?>    
    <div class="navigationBar">
        <nav>
            <ul>
                <li><a href="logout.php"><button class="logoutButton"><h4>Log Out</h4></button></a></li>
            </ul>
        </nav>
    </div><!--navigationBar-->  
    <main id="adminFeatures">
        <figure id="addRecipe">
            <h2>Add a Recipe</h2>
            <figcaption>
                <a href="addRecipe.php"><button><h4>Add a Recipe</h4></button></a>
            </figcaption>
        </figure>
        <figure id="deleteRecipe">
            <h2>Delete a Recipe</h2>
            <figcaption>
                <a href="displayRecipes.php"><button><h4>Display Recipes</h4></button></a>
            </figcaption>
        </figure>
    </main>
    <footer>
        <div class="footerNav">
            <ul>
                <li><a href="logout.php"><button class="logoutButton"><h4>Log Out</h4></button></a></li>
            </ul>    
        </div><!--footerNav-->    
            <p>Eats and Treats Copyright &copy <?php echo date("Y");?></p>        
    </footer>
    <?php
       }
        else {
        //display form
    ?>
    <div class="navigationBar">
    <img src="images/eatsAndTreatsLogo.png" alt="eats and treats logo">
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="aboutUs.html">About Us</a></li>
            <li><a href="recipeTips.html">Recipe Tips</a></li>
            <li><a href="recipeGallery.html">Recipes</a></li>
            <li><a href="submitRecipe.html">Submit Recipe</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
    </nav>
    </div><!--navigationBar-->  
    <main id="loginForm">
        <!--this section will display when the user asks to login to the application-->
        <form id="loginForm" name="loginForm" method="post" action="login.php">
            <legend>Log In</legend>
            <div class="errorMessageFormat">
                <?php
                    if (isset($errorMessage)) {
                        echo $errorMessage;
                    }
                ?>
            </div>
            <p>
                <label for="inUsername">Username: </label>
                <br>
                <input type="text" name="inUsername" id="inUsername" required>
            </p>
            <p>
                <label for="inPassword">Password: </label>
                <br>
                <input type="password" name="inPassword" id="inPassword" required>
            </p>
            <p>
                <input type="submit" name="submit" value="Submit">
                <input type="reset">
            </p>
        </form>
    </main>
    <footer>
        <div class="footerNav">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="aboutUs.html">About Us</a></li>
                <li><a href="recipeTips.html">Recipe Tips</a></li>
                <li><a href="recipeGallery.html">Recipes</a></li>
                <li><a href="submitRecipe.html">Submit Recipe</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>    
        </div><!--footerNav-->    
            <p>Eats and Treats Copyright &copy <?php echo date("Y");?></p>        
    </footer>   
    <?php
        }
    ?>
</body>
</html>