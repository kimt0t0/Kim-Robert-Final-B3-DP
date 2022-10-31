<?php

// Class to deal with the data file
class DataFile {

    public function __construct($path) {
        $this->path = $path;
        $this -> dataFile = fopen($this->path, "r") or die("Impossible d'ouvrir le fichier. Il y a probablement un problème avec le chemin indiqué.");
        echo "Fichier ouvert" . PHP_EOL; // Allows us to check opening / closing of files.
    }

    public function readFile() {
        $dataRead = fread($this->dataFile, filesize($this->path));
        return print($dataRead);
    }

    public function removeFile() {
        try {
            unlink($this->path);
            echo "Fichier supprimé." . PHP_EOL;
            return true;
        }
        catch (exception $e) {
            echo "Impossible de supprimer le fichier: " .$e . PHP_EOL;
            return false;
        }
    }

    public function convertFileToArray() {
        $dataRead = fread($this->dataFile, filesize($this->path));
        $newLine = "\n";
        $coma = ",";
        $space = " ";
        $splitData = explode($newLine, $dataRead);
        $dataArray[] = NULL;

        foreach($splitData as $str) {
            $row = explode($coma,trim($str));
            array_push($dataArray, $row);
        }

        array_splice($dataArray, 0, 2); //deletes the first line in the document, that has to be ignored

        return $dataArray;
    }

    // automates the file's closing
    public function closeFile() {
        try {
            fclose($this -> dataFile);
            echo "Fichier fermé" . PHP_EOL; // Allows us to check opening / closing of files.
            return true;
        }
        catch (error $e) {
            echo "Impossible de fermer le fichier" . $e . PHP_EOL; // Allows us to check opening / closing of files.
            return false;
        }
    }

}