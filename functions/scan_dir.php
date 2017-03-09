<?php
/**
 * Created by IntelliJ IDEA.
 * User: ps15
 * Date: 2/03/2017
 * Time: 4:44 PM
 */

//This function displays the main folders of the test results
function displayTestResultsTable(){
    $dir = "C:/xampp/htdocs/QAPortal/test_results";
    $array = scandir($dir, 0);
    if(!$array){
        die("Scanning failed");
    }

    echo '<div class="btn-group btn-group-vertical btn-group-md" data-toggle="buttons" style="width: 100%;">';
    foreach($array as $value){
        if($value !== '.' && $value !== '..'){
            echo '<label class="btn btn-default" onclick="displaySearchResults('.$value.')" id="'.$value.'">';
            echo '<input type="radio" name="options" autocomplete="off">';
            $value = str_replace("_", " ", $value);
            print_r(ucwords($value));
            echo '</label>';
        }
    }
    echo '</div>';
}

function displaySearchResults($value){

    echo '<div class="row">';
    echo $value;
    echo '<div>';

    $dir = "C:/xampp/htdocs/QAPortal/test_results/".$value;
    $testResults = scandir($dir, 0);


    if (!$testResults) {
        die("Scanning of test_results dir failed");
    } else {
        foreach ($testResults as $environment) {
            //Scan contents of subfolder environment
            $dirEnvironment = "C:/xampp/htdocs/QAPortal/test_results/" . $environment;
            echo $dirEnvironment . " </br>";
            $testSummary = scandir($dirEnvironment, 0);
            if (!$testSummary) {
                die("Scanning of test sumamary failed");
            }

        }
    }
}