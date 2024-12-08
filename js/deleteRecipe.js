/*
    get recipeId from selected button
    display a confirmation
        if yes redirect to deleteRecipe.php
        else do not delete recipe
*/
function deleteRecipeConfirmation(inRecipeId){
    //alert("inside deleteRecipeConfirmation() " + inRecipeId);
    let confirmDelete = confirm("To 'DELETE' this recipe click 'OK'. If you delete this recipe you cannot recover it.");
    if(confirmDelete == true) {
        //true = delete record
        window.location.href = "deleteRecipe.php?recipeId=" + inRecipeId;
    }
}