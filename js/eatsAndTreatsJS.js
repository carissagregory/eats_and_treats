//eats and treats javascript

//display current copyright year
let currentYear = new Date();

  function currentDate(currentYear) {
	let copyrightYear = currentYear.getFullYear();
	document.querySelector(".copyrightYear").innerHTML = copyrightYear;
}

currentDate(currentYear);

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

function validateRecipeFormFields() {
//add recaptcha to form
    //check that fields are not blank and text fields do not have numbers and cooking time should not have decimals
    //if all fields completed then submit the form
        //before submitting the form input all form data into a recipe object or recipe class
        //clear form fields and display confirmation message
    //else form should not submit and error message is displayed
    //alert("insideValidateRecipeFormFields()");

    //check if one of the recipeCategory radioButtons is selected
    let selectedRadioButton = false;
    recipeCategory.forEach (radioButton => {
        if (radioButton.checked) {
            selectedRadioButton = true;
        }
    });

    //check if all of the ingredient fields are not blank
    //  get both dynamically created and hardcoded fields after the template has been created
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

    //check if all of the direction fields are not blank
    let directionTextarea = document.querySelectorAll("textarea[id^='direction']");
    let directionFields = true;
    directionTextarea.forEach(direction => {
        if (direction.value.trim() == "") {
            directionFields = false;
        }
    });

    if (
            recipeName.value.trim() != "" && 
            recipeAuthor.value.trim() != "" && 
            recipeNumServings.value.trim() != "" && 
            recipeServingKind.value.trim() != "" &&
            recipeCookingTime.value.trim() != "" &&
            recipeDifficulty.value.trim() != "" &&
            selectedRadioButton &&
            recipeDescription.value.trim() != "" &&
            measurementFields &&
            volumeFields &&
            typeFields &&
            directionFields &&
            inRecipeImageName.value.trim() != "" &&
            inRecipeImage.files.length != 0
        ){
            alert("form fields are NOT blank");
            //all form fields pass validation
            //run the reset method
            //run the submit method

            //loadRecipesObject();
            submitRecipeForm.submit();
        }
        else {
            //form field(s) do not pass validation
            //display error message
            alert("form fields are blank")
        }
}