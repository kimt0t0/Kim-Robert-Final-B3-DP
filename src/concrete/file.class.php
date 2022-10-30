<?php

// Class to deal with the data file
class DataFile {

    public function __construct($path) {
        $this->path = $path;
    }

    public function readFile() {
        $dataFile = fopen($this->path, "r") or die("Impossible d'ouvrir le fichier. Il y a probablement un problème avec le chemin indiqué.");
        return print(fread($dataFile, filesize($this->path)));
    }

    // might be useful if we want to update the data later
    public function updateFile() {
        $dataFile = fopen($this->path, "a+"); //opens file in read&update mode - keeps the already existing content
    }

    public function convertFile() {
        $dataFile = fopen($this->path, "r") or die("Impossible d'ouvrir le fichier. Il y a probablement un problème avec le chemin indiqué.");
        $dataRead = fread($dataFile, filesize($this->path));
        $newLine = "\n";
        $coma = ',';
        $splitData = explode($newLine, $dataRead);
        $dataArray[] = NULL;

        foreach($splitData as $str) {
            $row = explode($coma, $str);
            array_push($dataArray, $row);
        }

        array_splice($dataArray, 0, 2); //deletes the first line in the document, that has to be ignored

        return print_r($dataArray);
    }

    // automates the file's closing
    public function closeFile() {
        return fclose($this->path);
    }

}

$dataFile = new DataFile("../../data/autoentreprises.csv");
$dataFile->convertFile();