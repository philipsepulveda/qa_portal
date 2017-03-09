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

function displaySearchResults(){
    //Scans the test_results folder
    $testResults = scandir("C:/xampp/htdocs/QAPortal/test_results/", 0);
    //Error comes up if scanning failed
    if(!$testResults){
        die("Scanning main directory failed");
    }else{
        //Traverses the contents of the test_results directory
        foreach ($testResults as $testServices){
            //Exclude first two contents
            if($testServices !== '.' && $testServices !== '..'){
                //Traverses the contents inside the testServices folders
                $testEnvironment = scandir("C:/xampp/htdocs/QAPortal/test_results/".$testServices , 0);
                if(!$testEnvironment) {
                    die("Scanning test results directory failed");
                }
                echo '<br>->'.$testServices;
                foreach ($testEnvironment as $testSummaryFile){
                    //
                    //
                    if($testSummaryFile !== '.' && $testSummaryFile !== '..'){
                        echo '<br>-->'. $testSummaryFile;
                        $theHtmlFile = scandir("C:/xampp/htdocs/QAPortal/test_results/".$testServices."/".$testSummaryFile);
                        if(!$testSummaryFile){
                            die("Scanning test summary file failed");
                        }
                        foreach ($theHtmlFile as $html){
                            if($html !== '.' && $html !== '..') {
                                echo '<br> --->' . $html;
                                //Read the html file as text and get elements for Test Run(Date), Environment(Dev, Stage, Prod or Test) and Summary
                            }
                        }
                    }
                }
            }
        }
    }

        echo '<tbody id="table-results">
            <tr>
                <td>
                    1
                </td>
                <td>
                    Development
                </td>
                <td>
                    01/04/2012
                </td>
            </tr>
            <tr>
                <td>
                    2
                </td>
                <td>
                    Development
                </td>
                <td>
                    02/04/2012
                </td>
            </tr>
        </tbody>';

//
//
//    $dir = "C:/xampp/htdocs/QAPortal/test_results/".$value;
//    $testResults = scandir($dir, 0);
//
//
//    if (!$testResults) {
//        die("Scanning of test_results dir failed");
//    } else {
//        foreach ($testResults as $environment) {
//            //Scan contents of subfolder environment
//            $dirEnvironment = "C:/xampp/htdocs/QAPortal/test_results/" . $environment;
//            echo $dirEnvironment . " </br>";
//            $testSummary = scandir($dirEnvironment, 0);
//            if (!$testSummary) {
//                die("Scanning of test sumamary failed");
//            }
//
//        }
//    }
}