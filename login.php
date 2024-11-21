<?php
    session_start();        //gives us access to a session, or starts a new one if needed
    //check if the form was submitted or needs to be displayed to the customer

    //$errorMessage = "";       //option 1- set global variable

    if($_SESSION['validSession'] === "yes"){
        //if you are a 'validSession' then you should see the Admin page 
        //  you do not need to sign on again
        $validUser = true;  //set flag for valid user to display the Admin Page
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
            $inPassword = $_POST['inPassword'];   //pull the username from the login form

            try{
                require '../../dbConnect.php';        //access to the database 
                
                //does the input username AND password MATCH the username AND password in the datebase?
                //SELECT for a specific set of data WHERE
                $sql = "SELECT COUNT(*) FROM eats_and_treats_users WHERE user_username = :username AND user_password = :password";
        
                $stmt = $conn->prepare($sql);
                
                // Bind parameters
                $stmt->bindParam(":username", $inUsername);
                $stmt->bindParam(":password", $inPassword);
            
                $stmt->execute();
                
                // Fetch the count
                $rowCount = $stmt->fetchColumn();       //get number of rows in result set/statement


                /* 
                echo "Username: $username <br>";
                echo "Password: $password <br>";
                echo "Count: $rowCount <br>";
                */
                if ($rowCount > 0) {
                    //valid username/passwod
                    //echo "<h3> Login successful </h3>";
                    $validUser = true;          //switch aka flag
                    $_SESSION['validSession'] = "yes";  //Valid user- allow access to the admin page
                } else {
                    //invalid
                    //echo "<h3> Invalid username or password </h3>";
                    $validUser = false;
                    $errorMessage = "Invalid username/password, please try again.";
                    $_SESSION['validSession'] = "no";       //invalid user - do Not allow access
                }
                
                $stmt->setFetchMode(PDO::FETCH_ASSOC);       //return values as an associative array
            
                // Prepare and execute the query

            }
            catch(PDOException $e) {
                echo "Database Failed: " . $e->getMessage();
            }
        }
        else {
            //the customer needs to see the form in order to fill it out and SUBMIT it for signin
        }
    }//end of check for 'validSession
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
    <meta name="keywords" content="">
    <meta name="descripton" content="Log In page">    
    <title>Log In Page</title>
</head>
<body class="container">
        <div class="navigationBar">
            <img src="images/eatsAndTreatsLogo.png" alt="eats and treats logo">
            <nav>
                <ul>
                    <button class="loginButton"><a href="php/logout.php">Log Out</a></button>
                </ul>
            </nav>
        </div><!--navigationBar-->  
        <main id="loginPage">
            <div id="">
            <figure>
                    <h2>Add a Recipe</h2>
                    <figcaption>
                        <button><a href="addRecipe.php" target="_blank">Add a Recipe</a></button>
                    </figcaption>
                </figure>
                <figure>
                    <h2>Delete a Recipe</h2>
                    <figcaption>
                        <button><a href="deleteRecipe.php" target="_blank">Delete a Recipe</a></button>
                    </figcaption>
                </figure>
            </div>
        </main>
        <footer>
            <div class="footerNav">
                <ul>
                    <button class="loginButton"><a href="index.html" onclick="logOut()">Log Out</a></button>
                </ul>    
            </div><!--footerNav-->    
                <p>Eats and Treats Copyright &copy <span class="copyrightYear">year</span></p>        
        </footer>
</body>
</html>