
// //cookie functions
// console.log(document.cookie);function setCookie(cookieName, cookieValue, expireDays) {
//     let expires = "";
    
//     if (expireDays) {
//         const today = new Date();
//         today.setTime(today.getTime() + (expireDays * 24 * 60 * 60 * 1000)); // Convert days to milliseconds
//         expires = "; expires=" + today.toUTCString();
//     }
    
//     document.cookie = cookieName + "=" + encodeURIComponent(cookieValue) + expires + "; path=/";
//     //located at: https://www.mbloging.com/post/how-to-read-write-and-delete-cookies-in-javascript
// }//end setCookie()

// function getCookieValue(name) {
//     const cookies = document.cookie.split(';');
    
//     for (let cookie of cookies) {
//         const [cookieName, cookieValue] = cookie.trim().split('=');
        
//         if (cookieName === name) {
//         return decodeURIComponent(cookieValue);
//         }
//     }
    
//     return null; // Cookie not found
// }//end getCookieValue()

// function deleteCookie(name) {
//     document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
// }//end deleteCookie

// console.log(document.cookie);

/*
    When 0.5x button is clicked 
        divide all ingredient measurements by 2
        divide number of servings by 2
    When 1x button is clicked 
        display ingredient measurements values from the database(the default)
        display number of servings value from the database(the default)
    When 2x button is clicked
        multiply all ingredient measurements by 2
        multiply number of servings by 2
*/

let recipeIdParameter = window.location.search;
let urlParameter = new URLSearchParams(recipeIdParameter);
let urlRecipeId = urlParameter.get("recipeId");
//console.log(urlRecipeId);

let individualRecipeContainer = document.querySelector("#recipeContainer");

fetch("php/fetchRecipes.php")
.then(response => response.json())
.then( recipes =>{
    //console.log(recipes);
    let individualRecipe = [];
    //let recipeCookieCounter = 0;
    for (let x = 0; x < recipes.length; x++) {
        if (recipes[x].recipeId == urlRecipeId) {
            individualRecipe.push(recipes[x]);

            let templateObject = document.querySelector("template");
            let individualRecipeObject = templateObject.content.cloneNode(true);
            console.log(individualRecipeObject);

            let recipeName = individualRecipeObject.querySelector("#recipeName");
            recipeName.innerHTML = recipes[x].recipeName;

            let recipeAuthor = individualRecipeObject.querySelector("#recipeInformation #recipeHeadings h3:nth-child(1)");
            recipeAuthor.innerHTML = recipes[x].recipeAuthor;

            let recipeServingNum = individualRecipeObject.querySelector("#servingNumber");
            let recipeServingKind = individualRecipeObject.querySelector("#servingKind");
            //recipeServingNum.innerHTML = recipes[x].recipeNumServings;
            recipeServingKind.innerHTML = recipes[x].recipeServingKind;

            let recipeCookingTime = individualRecipeObject.querySelector("#recipeInformation #recipeHeadings h3:nth-child(3)");
            recipeCookingTime.innerHTML = recipes[x].recipeCookingTime + " minutes";

            let recipeDifficulty = individualRecipeObject.querySelector("#recipeInformation #recipeHeadings h3:nth-child(4)");
            recipeDifficulty.innerHTML = recipes[x].recipeDifficulty;

            let recipeCategory = individualRecipeObject.querySelector("#recipeInformation #recipeHeadings h3:nth-child(5)");
            recipeCategory.innerHTML = recipes[x].recipeCategory;

            let recipeImage = individualRecipeObject.querySelector("#recipeImage");
            //recipeImg.src = recipes[x].recipeImage;
            recipeImage.src = "images/uploadedImages/pancakes.jpg";
            recipeImage.alt = recipes[x].recipeImageName + " Image";
            
            let halfServingBtn = individualRecipeObject.querySelector("#halfServing h4");
            halfServingBtn.onclick = () => displayUpdatedServings(0.5);
            halfServingBtn.innerHTML = "0.5x";

            let defaultServingBtn = individualRecipeObject.querySelector("#defaultServing h4");
            defaultServingBtn.onclick = () => displayDefaultServings();
            defaultServingBtn.innerHTML = "1x";

            let doubleServingBtn = individualRecipeObject.querySelector("#doubleServing h4");
            doubleServingBtn.onclick = () => displayUpdatedServings(2);
            doubleServingBtn.innerHTML = "2x";
       
            let recipeDescription = individualRecipeObject.querySelector("#recipeDescription");
            //console.log(recipeDescription);
            recipeDescription.innerHTML = recipes[x].recipeDescription;

            let recipeIngredientsBtn = individualRecipeObject.querySelector("#ingredients .ingredientsAccordion");
            recipeIngredientsBtn.innerHTML = "Ingredients";

            let measurementArray = JSON.parse(recipes[x].recipeMeasurements);
            let volumeArray = JSON.parse(recipes[x].recipeVolumes);
            let typeArray = JSON.parse(recipes[x].recipeTypes);

            let ingredientsList = individualRecipeObject.querySelector(".ingredientsPanel ul");

            //get default serving amount and ingredient measurements
            let defaultServingNum = recipes[x].recipeNumServings;
            let defaultMeasurements = JSON.parse(recipes[x].recipeMeasurements);    

            function displayUpdatedServings(operator) {
                let updatedServings = defaultServingNum * operator;
                recipeServingNum.innerHTML = updatedServings;

                ingredientsList.innerHTML = "";

                for (let u = 0; u < measurementArray.length; u++) {
                    let ingredientListElement = document.createElement("li");

                    let updatedMeasurements = defaultMeasurements[u] * operator;

                    let measurementSection = document.createElement("span");
                    measurementSection.setAttribute("class", "measurement");
                    measurementSection.innerHTML = updatedMeasurements + " ";

                    let volumeSection = document.createElement("span");
                    volumeSection.setAttribute("class", "volume");
                    volumeSection.innerHTML = volumeArray[u] + " ";

                    let typeSection = document.createElement("span");
                    typeSection.setAttribute("class", "type");
                    typeSection.innerHTML = typeArray[u];

                    ingredientListElement.appendChild(measurementSection);
                    ingredientListElement.appendChild(volumeSection);
                    ingredientListElement.appendChild(typeSection);

                    ingredientsList.appendChild(ingredientListElement);
                }  
            }


            function displayDefaultServings() {
                recipeServingNum.innerHTML = defaultServingNum;

                ingredientsList.innerHTML = "";

                for (let m = 0; m < measurementArray.length; m++) {
                    let ingredientListElement = document.createElement("li");

                    let measurementSection = document.createElement("span");
                    measurementSection.setAttribute("class", "measurement");
                    measurementSection.innerHTML = defaultMeasurements[m] + " ";

                    let volumeSection = document.createElement("span");
                    volumeSection.setAttribute("class", "volume");
                    volumeSection.innerHTML = volumeArray[m] + " ";

                    let typeSection = document.createElement("span");
                    typeSection.setAttribute("class", "type");
                    typeSection.innerHTML = typeArray[m];

                    ingredientListElement.appendChild(measurementSection);
                    ingredientListElement.appendChild(volumeSection);
                    ingredientListElement.appendChild(typeSection);

                    ingredientsList.appendChild(ingredientListElement);
                }                
            }

            displayDefaultServings();

            let recipeDirectionsBtn = individualRecipeObject.querySelector("#directions .directionsAccordion");
            recipeDirectionsBtn.innerHTML = "Directions";

            let directionArray = JSON.parse(recipes[x].recipeDirections);
            let directionsList = individualRecipeObject.querySelector(".directionsPanel ol");
            directionsList.innerHTML = "";

            for (let d = 0; d < directionArray.length; d++) {
                let directionListElement = document.createElement("li");
                directionListElement.innerHTML = directionArray[d];
                directionsList.appendChild(directionListElement);

            }

            individualRecipeContainer.appendChild(individualRecipeObject);
            //recipeCookieCounter++;   

            //acccordion functionality
            let accordionButtons = document.querySelectorAll(".ingredientsAccordion, .directionsAccordion");

            accordionButtons.forEach(function(button) {
                button.onclick = function() {
                    let panel = button.nextElementSibling;

                    if (panel.style.display === "block") {
                        panel.style.display = "none";
                    } else {
                        panel.style.display = "block";
                    }
                }
            });            
        }
    }
    //console.log(individualRecipe);
});


