//js for recipeGallery.html
/*
recipeGallery.html js
    use Fetch to get recipe json from fetchRecipe.php
    create empty arrays for breakfast, entree, and dessert recipes
    loop through json response for breakfast, entree, and dessert recipes
        loop through recipes arrays 
        create template with data from arrays

    template fields
        -figure, id="breakfastRecipe1"
            -img
                -scr
                -alt
        -figcaption
            -h2, recipeName
            -p, description
            -button, include recipeId as a parameter in link when sending to individual recipe page
*/


//breakfast recipes
let breakfastSection = document.querySelector("#breakfastRecipes");
fetch("php/fetchRecipes.php")
.then(response => response.json())
.then( recipes =>{
    //console.log(recipes);
    let breakfastRecipes = [];
    let bRecipeCounter = 1;
    for (let x = 0; x < recipes.length; x++) {
        if (recipes[x].recipeCategory === "breakfast") {
            breakfastRecipes.push(recipes[x]);

            let templateObject = document.querySelector("#bFigureTemplate");
            let breakfastObject = templateObject.content.cloneNode(true);
            //console.log(breakfastObject);

            let updateFigureId = breakfastObject.querySelector("figure");
            updateFigureId.id = "breakfastRecipe" + bRecipeCounter;

            let figureImg = breakfastObject.querySelector("img");
            //figureImg.src = recipes[x].recipeImage;
            figureImg.src = "images/uploadedImages/pancakes.jpg";
            figureImg.alt = recipes[x].recipeImageName + " Image";

            let recipeName = breakfastObject.querySelector("figcaption h2");
            recipeName.innerHTML = recipes[x].recipeName;

            let recipeDescription = breakfastObject.querySelector("figcaption p");
            recipeDescription.innerHTML = recipes[x].recipeDescription;

            let recipeBtnLink = breakfastObject.querySelector("a");
            recipeBtnLink.href = "individualRecipe.html?recipeId=" + recipes[x].recipeId;

            breakfastSection.appendChild(breakfastObject);

            bRecipeCounter++;        
        }
    }
    //console.log(breakfastRecipes);
});


//entree recipes
let entreeSection = document.querySelector("#entreeRecipes");
fetch("php/fetchRecipes.php")
.then(response => response.json())
.then( recipes =>{
    //console.log(recipes);
    let entreeRecipes = [];
    let eRecipeCounter = 1;
    for (let x = 0; x < recipes.length; x++) {
        if (recipes[x].recipeCategory === "entree") {
            entreeRecipes.push(recipes[x]);

            let templateObject = document.querySelector("#eFigureTemplate");
            let entreeObject = templateObject.content.cloneNode(true);

            let updateFigureId = entreeObject.querySelector("figure");
            updateFigureId.id = "entreeRecipe" + eRecipeCounter;

            let figureImg = entreeObject.querySelector("img");
            //figureImg.src = recipes[x].recipeImage;
            figureImg.src = "images/uploadedImages/pumpkinSoup.jpg";
            figureImg.alt = recipes[x].recipeImageName + " Image";

            let recipeName = entreeObject.querySelector("figcaption h2");
            recipeName.innerHTML = recipes[x].recipeName;

            let recipeDescription = entreeObject.querySelector("figcaption p");
            recipeDescription.innerHTML = recipes[x].recipeDescription;

            let recipeBtnLink = entreeObject.querySelector("a");
            recipeBtnLink.href = "individualRecipe.html?recipeId=" + recipes[x].recipeId;

            entreeSection.appendChild(entreeObject);

            eRecipeCounter++; 
        }
    }
   //console.log(entreeRecipes); 
});


//dessert recipes
let dessertSection = document.querySelector("#dessertRecipes");
fetch("php/fetchRecipes.php")
.then(response => response.json())
.then( recipes =>{
    //console.log(recipes);
    let dessertRecipes = [];
    let dRecipeCounter = 1;
    for (let x = 0; x < recipes.length; x++) {
        if (recipes[x].recipeCategory === "dessert") {
            dessertRecipes.push(recipes[x]);

            let templateObject = document.querySelector("#dFigureTemplate");
            let dessertObject = templateObject.content.cloneNode(true);

            let updateFigureId = dessertObject.querySelector("figure");
            updateFigureId.id = "entreeRecipe" + dRecipeCounter;

            let figureImg = dessertObject.querySelector("img");
            //figureImg.src = recipes[x].recipeImage;
            figureImg.src = "images/uploadedImages/chocolateChipBundtCake.jpg";
            figureImg.alt = recipes[x].recipeImageName + " Image";

            let recipeName = dessertObject.querySelector("figcaption h2");
            recipeName.innerHTML = recipes[x].recipeName;

            let recipeDescription = dessertObject.querySelector("figcaption p");
            recipeDescription.innerHTML = recipes[x].recipeDescription;

            let recipeBtnLink = dessertObject.querySelector("a");
            recipeBtnLink.href = "individualRecipe.html?recipeId=" + recipes[x].recipeId;

            dessertSection.appendChild(dessertObject);

            dRecipeCounter++; 
        }
    }
    //console.log(dessertRecipes);
});
