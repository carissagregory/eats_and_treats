//js for submitRecipe.html and addRecipe.php

let submitRecipeForm = document.querySelector("#submitRecipeForm");

//  get form values
let recipeName = document.querySelector("#recipeName");
let recipeAuthor = document.querySelector("#recipeAuthor");
let recipeNumServings = document.querySelector("#recipeNumServings");
let recipeServingKind = document.querySelector("#recipeServingKind");
let recipeCookingTime = document.querySelector("#recipeCookingTime");
let recipeDifficulty = document.querySelector("#recipeDifficultyLevel");
let recipeCategory = document.querySelectorAll("input[name='recipeCategory']");
let recipeDescription = document.querySelector("#recipeDescription");
let inRecipeImageName = document.querySelector("#inRecipeImageName");
let inRecipeImage = document.querySelector("#inRecipeImage");

let ingredientCounter = 2;

function addIngredientFields() {
    //display a set of ingredient fields when use clicks ingredient button
    //  access the template object
    //  create a counter to update the for, name, and id attributed on the measurement, volume, and ingredient fields
    //  assign variables for the measurement, volume, and ingredient fields through the templateObject
    //  append fields to ingredient section
    //  update counter after appending
    //alert("inside addIngredientFields()");
    let templateObject = document.querySelector("#ingredientTemplate"); 
    let addIngredientFields = templateObject.content.cloneNode(true); 
    //console.log(addIngredientFields);

    /* 
    let updatePId = addIngredientFields.querySelector("#ingredient1");
    updatePId.id = "ingredient" + counter;
    //console.log(updatePId);
    */
    let updateMeasurementFor = addIngredientFields.querySelector("label[for='ingredient1Measurement']");
    updateMeasurementFor.htmlFor = "ingredient" + ingredientCounter + "Measurement";
    let updateMeasurementField = addIngredientFields.querySelector("#ingredient1Measurement");
    updateMeasurementField.id = "ingredient" + ingredientCounter + "Measurement";
    updateMeasurementField.name = "ingredient" + ingredientCounter + "Measurement";
   //console.log(addIngredientFields);

   let updateVolumeFor = addIngredientFields.querySelector("label[for='ingredient1Volume']");
   updateVolumeFor.htmlFor = "ingredient" + ingredientCounter + "Volume";   
   let updateVolumeField = addIngredientFields.querySelector("#ingredient1Volume");
   updateVolumeField.id = "ingredient" + ingredientCounter + "Volume";
   updateVolumeField.name = "ingredient" + ingredientCounter + "Volume";

   let updateTypeFor = addIngredientFields.querySelector("label[for='ingredient1Type']");
   updateTypeFor.htmlFor = "ingredient" + ingredientCounter + "Type";   
   let updateTypeField = addIngredientFields.querySelector("#ingredient1Type");
   updateTypeField.id = "ingredient" + ingredientCounter + "Type";
   updateTypeField.name = "ingredient" + ingredientCounter + "Type";
   //console.log(addIngredientFields);

   document.querySelector("#ingredientsFields").appendChild(addIngredientFields);
    
   ingredientCounter++;
}

let directionCounter = 2;

function addDirectionField() {
    //display direction fields when use clicks direction button
    //  access the template object
    //  create a counter to update the for, name, and id attributed on the measurement, volume, and ingredient fields
    //  assign variables for the measurement, volume, and ingredient fields through the templateObject
    //  append fields to direction section
    //  update counter after appending
    //alert("inside addDirectionField()");
    let templateObject = document.querySelector("#directionTemplate"); 
    let addDirectionFields = templateObject.content.cloneNode(true); 

    let updateDirectionLabel = addDirectionFields.querySelector("label[for='direction1']");
    updateDirectionLabel.htmlFor = "direction" + directionCounter;
    updateDirectionLabel.innerHTML = directionCounter + ".";

    let updateDirectionNumber = addDirectionFields.querySelector("#direction1");
    updateDirectionNumber.id = "direction" + directionCounter;
    updateDirectionNumber.name = "direction" + directionCounter;
    //console.log(updateDirectionNumber);

    document.querySelector("#directionsFields").appendChild(addDirectionFields);
    
    directionCounter++;
}

//assign variables to  error spans
let nameError = document.querySelector("#nameError");
let authorError = document.querySelector("#authorError");
let numServingsError = document.querySelector("#numServingsError");
let servingKindError = document.querySelector("#servingKindError");
let cookingTimeError = document.querySelector("#cookingTimeError");
let difficultyError = document.querySelector("#difficultyError");
let categoryError = document.querySelector("#categoryError");
let descriptionError = document.querySelector("#descriptionError");
let imageNameError = document.querySelector("#imageNameError");
let imageError = document.querySelector("#imageError");
let ingredientError = document.querySelector("#ingredientError");
let directionError = document.querySelector("#directionError");

function validateRecipeFormFields() {
    let ingredientMeasurement = document.querySelectorAll("input[id$='Measurement']");
    let ingredientVolume = document.querySelectorAll("select[id$='Volume']");
    let ingredientType = document.querySelectorAll("input[id$='Type']");

    let measurementFields = true;
    ingredientMeasurement.forEach (measurement => {
        if (measurement.value.trim() == "") {
            measurementFields = false;
        }
    });
    //console.log(ingredientMeasurement);
 
 
    let volumeFields = true;
    ingredientVolume.forEach(volume => {
        if (volume.value == "") {
            volumeFields = false;
        }
    });
 
 
    let typeFields = true;
    ingredientType.forEach(type => {
        if (type.value.trim() == "") {
            typeFields = false;
        }
    });

    //check that all of the direction fields are not blank
   let directionTextarea = document.querySelectorAll("textarea[id^='direction']");
   let directionFields = true;
   directionTextarea.forEach(direction => {
       if (direction.value.trim() == "") {
           directionFields = false;
       }
   });

 
//add recaptcha to form
    //validate fields
        //check that all fields are not blank
        //text fields do not have numbers 
        //cooking time should not have decimals
   //if all fields completed then submit the form
       //display confirmation message
   //else form should not submit and error message is displayed
   //alert("insideValidateRecipeFormFields()");
   let validForm = true;

   nameError.innerHTML = "";
   authorError.innerHTML = "";
   numServingsError.innerHTML = "";
   servingKindError.innerHTML = "";
   cookingTimeError.innerHTML = "";
   difficultyError.innerHTML = "";
   categoryError.innerHTML = "";
   descriptionError.innerHTML = "";
   imageNameError.innerHTML = "";
   imageError.innerHTML = "";
   ingredientError.innerHTML = "";
   directionError.innerHTML = "";

   if (recipeName.value.trim() === "") {
        nameError.innerHTML = "Recipe name cannot be blank.";
        validForm = false;
    }
    if (recipeAuthor.value.trim() === "") {
        authorError.innerHTML = "Recipe author cannot be blank.";
        validForm = false;
    }
    if (recipeNumServings.value.trim() === "") {
        numServingsError.innerHTML = "Number of Servings cannot be blank.";
        validForm = false;
    }
    if (recipeServingKind.value.trim() === "") {
        servingKindError.innerHTML = "Type of serving cannot be blank.";
        validForm = false;
    }
    if (recipeCookingTime.value.trim() === "") {
        cookingTimeError.innerHTML = "Cooking Time cannot be blank.";
        validForm = false;
    }
    if (recipeDifficulty.value.trim() === "") {
        difficultyError.innerHTML = "Recipe difficulty cannot be blank.";
        validForm = false;
    }
    //check if one of the recipeCategory radioButtons is selected
    let selectedRadioButton = false;
    recipeCategory.forEach (radioButton => {
        if (radioButton.checked) {
            selectedRadioButton = true;
        }
    })
    if (!selectedRadioButton){
        categoryError.innerHTML = "A recipe category must be selected";
        validForm = false;
    }
    if (recipeDescription.value.trim() === "") {
        descriptionError.innerHTML = "Recipe description cannot be blank.";
        validForm = false;
    }
    if (!measurementFields || !volumeFields || !typeFields) {
        validForm = false;
        ingredientError.innerHTML = "Ingredient measurement, volume, and type cannot be blank."
    }
    if (!directionFields){
        validForm = false;
        directionError.innerHTML = "Recipe directions cannot be blank."
    }
    if (inRecipeImageName.value.trim() === "") {
        imageNameError.innerHTML = "Recipe image name cannot be blank.";
        validForm = false;
    }
    if (inRecipeImage.value.trim() === "") {
        imageError.innerHTML = "A file must be selected.";
        validForm = false;
    }
    //if form passes validation, submit
    if(validForm) {
        submitRecipeForm.submit();
    }
}