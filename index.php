<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */

require_once ABSPATH . './src/concrete/DataFile.class.php';
require_once ABSPATH . './src/concrete/SelfEmployees/SelfEmployee.class.php';

/* ACTIONS */

//Instanciate file object
$dataFile = new DataFile("./data/autoentreprises.csv");
//Convert text file to array
$dataArray = $dataFile->convertFile();
$dataFile->closeFile();

// You can activate the following lines to test file removal:
// $fileToRemove = new DataFile("./data/testfile.csv");
// $fileToRemove->removeFile();

//Instanciate self-employee objects
for ($counter=0; $counter < count($dataArray); $counter += 1) {
    ${"user" . $counter} = new SelfEmployee($counter, $dataArray[$counter]);
    ${"user" . $counter}->__toString();
}