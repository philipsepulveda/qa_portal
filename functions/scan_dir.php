<?php
/**
 * User: ps15
 * Date: 2/03/2017
 * Time: 4:44 PM
 */
//Change this path to specify the directory of the test_results folder
$rootAppDir = "C:/xampp/htdocs/THL_QAPortal/test_results/";

function displaySearchResults($rootAppDir)
{
    //Checks whether path exists
    if (is_dir($rootAppDir)) {
        $rootAppDirArray = scandir($rootAppDir, 0);
        //Error comes up if scanning failed
        if (!$rootAppDirArray) {
            die("Scanning main directory failed");
        } else {
            //Traverses the contents of the test_results directory
            echo '<tbody id="table-results">';
            traverseTestResultsFolder($rootAppDir, $rootAppDirArray);
            echo '</tbody>';
        }
    } else {
        echo 'Error encountered while scanning test_results folder. Please make sure the directory exists.';
    }
}

function traverseTestResultsFolder($rootAppDir, $rootAppDirArray)
{
    foreach ($rootAppDirArray as $environmentDir) {
        //Exclude first two contents of the directory which is "." and ".."
        if ($environmentDir !== '.' && $environmentDir !== '..') {
            //Concatenates the service to the root directory to access its contents
            $environmentDirArray = $rootAppDir . $environmentDir;
            //Checks whether path exists
            if (is_dir($environmentDirArray)) {
                $environmentDirArray = scandir($environmentDirArray, 0);
                if (!$environmentDirArray) {
                    die("Scanning test results directory failed");
                }
                //Calls the method that traverses the contents of each service
                traverseEnvironmentFolder($rootAppDir, $environmentDirArray, $environmentDir);
            } else {
                echo 'Error encountered while scanning services folder. Please make sure the directory exists.';
            }
        }
    }
}

function traverseEnvironmentFolder($rootAppDir, $environmentDirArray, $environmentDir)
{
    foreach ($environmentDirArray as $testSummary) {
        //Exclude first two contents of the directory which is "." and ".."
        if ($testSummary !== '.' && $testSummary !== '..') {
            //Concatenates the html file to the environment directory to access its contents
            $htmlDir = $rootAppDir . $environmentDir . "/" . $testSummary;
            //Checks whether path exists
            if (is_dir($htmlDir)) {
                $theHtmlFile = scandir($htmlDir, 0);
                if (!$testSummary) {
                    die("Scanning test summary file failed");
                }
                //Calls the method that traverses the contents of html files for each service
                displayTestRun($htmlDir, $theHtmlFile, $testSummary, $environmentDir);
            } else {
                echo 'Error encountered while scanning environments folder. Please make sure the directory is in the correct hierarchy.<br>test_results/service/environment/test_summary';
            }
        }
    }
}

function displayTestRun($htmlDir, $theHtmlFile, $testSummary, $environmentDir)
{
    foreach ($theHtmlFile as $html) {
        //Path of python scripts html_scraper.py and html_test_run.py that scrapes the data off the html files
        $summary = "C://Python27/python.exe C://xampp/htdocs/THL_QAportal/html_scraper.py ";
        $testRun = "C://Python27/python.exe C://xampp/htdocs/THL_QAportal/html_test_run.py ";
        //Exclude first two contents of the directory which is "." and ".."
        if ($html !== '.' && $html !== '..') {
            //Concatenates the html name to the environment directory for python script execution
            $summary .= $htmlDir."/".$html;
            $testRun .= $htmlDir."/".$html;
            if ($html !== "") {
                //Read the html file as text and get elements for Test Run(Date), Environment(Dev, Stage, Prod or Test) and Summary
                echo '<tr>
                        <td>' .ucwords(str_replace("_", " ", $environmentDir)).'</td>
                        <td>' . exec($testRun) . '</td>
                        <td>' . ucwords($testSummary) . '</td>
                        <td>' . exec($summary). '</td>
                        </tr>';
            }
        }
    }
}