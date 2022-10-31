<?php

class HtmlReport implements IReport {

    public function __construct($name, $dataArray) {
        $this->path = $this->setReportPath($name);
        print("Ecriture du rapport...");
        $this->writeReport($this->path, $dataArray);
        print("Vérification du rapport: ");
        $this->readReport($this->path);
    }

    public function setReportPath($name) {
        $path = "./data/reports/html" . $name . ".txt";
        return $path;
    }

    public function writeReport($path, $dataArray) {
        $reportFile = fopen($path, "w") or die("Impossible de créer le fichier dans la destination: " . $path); //will erase existing file of same name and destination if it exists - replace "w" with "x" if you want to launch an error if file already exists
        fwrite($reportFile, "");
        foreach ($dataArray as $newline) {
            fwrite($reportFile, $newline);
        }
        fclose($reportFile);
    }

    public function readReport($path) {
        fopen($path, "r");
        fread($path, filesize($path));
        fclose($path);
    }

}