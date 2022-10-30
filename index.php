<?php

require './src/concrete/DataFile.class.php';


//Instanciate file object
$dataFile = new DataFile("./data/autoentreprises.csv");
//Convert text file to array
$dataFile->convertFile();
$dataFile->closeFile();

// You can activate the following lines to test file removal:
// $fileToRemove = new DataFile("./data/testfile.csv");
// $fileToRemove->removeFile();