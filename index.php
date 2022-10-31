<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */

require_once ABSPATH . './src/concrete/DataFile.class.php';
require_once ABSPATH . './src/concrete/SelfEmployees/ConcreteSelfEmployee.class.php';

/* ACTIONS */

//Instanciate file object
$dataFile = new DataFile("./data/autoentreprises.csv");
//Convert text file to array
$dataArray = $dataFile->convertFileToArray();
$dataFile->closeFile();

// You can activate the following lines if you wish to test file removal:
// $fileToRemove = new DataFile("./data/testfile.csv");
// $fileToRemove->removeFile();

// Instanciate self-employee objects for each line in the file/array:
for ($counter=0; $counter < count($dataArray); $counter += 1) {
    ${"user" . $counter} = new ConcreteSelfEmployee($counter, $dataArray[$counter]);
    // Check siret number and skip to next line of incorrect:
    if (${"user" . $counter}->checkSiret() !== true) {
        print("Numéro de siret inexact, rapport abandonné.\n\n");
        continue;
    }
    // Store user info:
    $userInfo = ${"user" . $counter}->storeUserInfo();
    print_r($userInfo);
}