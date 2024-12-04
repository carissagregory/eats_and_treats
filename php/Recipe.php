<?php

class Recipe {
    //properties
    private $directionArray;
    private $measurementArray;
    private $recipeAuthor;
    private $recipeCategory;
    private $recipeCookingTime;
    private $recipeDescription;
    private $recipeDifficulty;
    private $recipeImage; 
    private $recipeImageName;   
    private $recipeName;
    private $recipeNumServings;
    private $typeArray;
    private $recipeServingKind;
    private $volumeArray;
    
    //constructor method
    function _construct(){
        $this->directionArray = [];
        $this->measurementArray = [];
        $this->recipeAuthor = "";
        $this->recipeCategory = "";        
        $this->recipeCookingTime = 0;
        $this->recipeDescription = "";
        $this->recipeDifficulty = "";
        $this->recipeImage = "";
        $this->recipeImageName = "";
        $this->recipeName = "";        
        $this->recipeNumServings = 0;
        $this->recipeServingKind = "";
        $this->typeArray = [];
        $this->volumeArray = [];
    }

    //setters and getters
    function setDirectionArray($inDirections){
        $this->directionArray = $inDirections;
    }
    function getDirectionArray(){
        return $this->directionArray;
    }

    function setMeasurementArray($inMeasurements){
        $this->measurementArray = $inMeasurements;
    }
    function getMeasurementArray(){
        return $this->measurementArray;
    }

    function setRecipeAuthor($inAuthor){
        $this->recipeAuthor = $inAuthor;
    }
    function getRecipeAuthor(){
        return $this->recipeAuthor;
    }

    function setRecipeCategory($inCategory){
        $this->recipeCategory = $inCategory;
    }
    function getRecipeCategory(){
        return $this->recipeCategory;
    }

    function setRecipeCookingTime($inCookingTime){
        $this->recipeCookingTime = $inCookingTime;
    }
    function getRecipeCookingTime(){
        return $this->recipeCookingTime;
    }

    function setRecipeDescription($inDescription){
        $this->recipeDescription = $inDescription;
    }
    function getRecipeDescription(){
        return $this->recipeDescription;
    }

    function setRecipeDifficulty($inDifficulty){
        $this->recipeDifficulty = $inDifficulty;
    }
    function getRecipeDifficulty(){
        return $this->recipeDifficulty;
    }

    function setRecipeImage($inImage){
        $this->recipeImage = $inImage;
    }
    function getRecipeImage(){
        return $this->recipeImage;
    }

    function setRecipeImageName($inImageName){
        $this->recipeImageName = $inImageName;
    }
    function getRecipeImageName(){
        return $this->recipeImageName;
    }

    function setRecipeName($inName){
        $this->recipeName = $inName;
    }
    function getRecipeName(){
        return $this->recipeName;
    }    

    function setRecipeNumServings($inNumServings){
        $this->recipeNumServings = $inNumServings;
    }
    function getRecipeNumServings(){
        return $this->recipeNumServings;
    }

    function setRecipeServingKind($inServingKind){
        $this->recipeServingKind = $inServingKind;
    }
    function getRecipeServingKind(){
        return $this->recipeServingKind;
    }

    function setTypeArray($inTypes){
        $this->typeArray = $inTypes;
    }
    function getTypeArray(){
        return $this->typeArray;
    }

    function setVolumeArray($inVolumes){
        $this->volumeArray = $inVolumes;
    }
    function getVolumeArray(){
        return $this->volumeArray;
    }

}
?>