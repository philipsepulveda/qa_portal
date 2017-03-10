<?php
/**
 * Created by IntelliJ IDEA.
 * User: ps15
 * Date: 2/03/2017
 * Time: 4:44 PM
 */
//Change this path to specify the directory of the test_results folder
$rootAppDir = "C:/xampp/htdocs/THL_QAPortal/test_results/";

//This function displays the main folders of the test results
function displayTestResultsTable($rootAppDir){
    if(is_dir($rootAppDir)){
        $rootAppDirArray = scandir($rootAppDir, 0);
        if(!$rootAppDirArray){
            die("Scanning failed");
        }
        echo '<div class="btn-group btn-group-vertical btn-group-md" data-toggle="buttons" style="width: 100%;">';
        foreach($rootAppDirArray as $environmentDir){
            if($environmentDir !== '.' && $environmentDir !== '..'){
                echo '<label class="btn btn-default" onclick="displaySearchResults('.$environmentDir.')" id="'.$environmentDir.'">';
                echo '<input type="radio" name="options" autocomplete="off">';
                $environmentDir = str_replace("_", " ", $environmentDir);
                print_r(ucwords($environmentDir));
                echo '</label>';
            }
        }
        echo '</div>';
    }else{
        echo 'Error encountered while scanning test_results folder. Please make sure the directory exists.';
    }
}

function displaySearchResults($rootAppDir){
    //Checks whether path exists
    if(is_dir($rootAppDir)){
        $rootAppDirArray = scandir($rootAppDir, 0);
        //Error comes up if scanning failed
        if(!$rootAppDirArray){
            die("Scanning main directory failed");
        }else{
            //Traverses the contents of the test_results directory
            echo '<tbody id="table-results">';
            traverseTestResultsFolder($rootAppDir, $rootAppDirArray);
            echo '</tbody>';
        }
    }else{
        echo 'Error encountered while scanning test_results folder. Please make sure the directory exists.';
    }
}

function traverseTestResultsFolder($rootAppDir, $rootAppDirArray){
    foreach ($rootAppDirArray as $environmentDir){
        //Exclude first two contents
        if($environmentDir !== '.' && $environmentDir !== '..'){
            //Traverses the contents inside the testServices folders
            $environmentDirArray = $rootAppDir.$environmentDir;
            //Checks whether path exists
            if(is_dir($environmentDirArray)){
                $environmentDirArray = scandir($environmentDirArray , 0);
                if(!$environmentDirArray) {
                    die("Scanning test results directory failed");
                }
//                echo '<br>->'.$environmentFolder;
                traverseEnvironmentFolder($rootAppDir, $environmentDirArray, $environmentDir);
            }else{
                echo 'Error encountered while scanning services folder. Please make sure the directory exists.';
            }
        }
    }
}

function traverseEnvironmentFolder($rootAppDir, $environmentDirArray, $environmentDir){
    foreach ($environmentDirArray as $testSummary){
        //Traverses the HTML files of each test environment folders
        if($testSummary !== '.' && $testSummary !== '..'){
//            echo '<br>-->'. $testSummaryFile;
            $theHtmlFile = $rootAppDir.$environmentDir."/".$testSummary;
            if(is_dir($theHtmlFile)){
                $theHtmlFile = scandir($theHtmlFile,0);
                if(!$testSummary){
                    die("Scanning test summary file failed");
                }
                displayTestRun($theHtmlFile, $testSummary);
            }else{
                echo 'Error encountered while scanning environments folder. Please make sure the directory is in the correct hierarchy.<br>test_results/service/environment/test_summary';
            }
        }
    }
}

function displayTestRun($theHtmlFile, $testSummary){
    foreach ($theHtmlFile as $html){
        if($html !== '.' && $html !== '..') {
//            echo '<br>-->'. $html;
            if($html !== ""){
                //Read the html file as text and get elements for Test Run(Date), Environment(Dev, Stage, Prod or Test) and Summary
                echo '<tr>
                        <td>'.str_replace("_", "-", substr($html,0,10)).' '.str_replace("_", ":", substr($html,11,5)).'</td>
                        <td>'.ucwords($testSummary).'</td>
                        <td>Stories: NULL | Scenarios: NULL | Passed : NULL | Inconclusive: NULL | Not Implemented: NULL | Failed: NULL </td>
                      </tr>';
            }
        }
    }
}

function searchBddfy(){

}