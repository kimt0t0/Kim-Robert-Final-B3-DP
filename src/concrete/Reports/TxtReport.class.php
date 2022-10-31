<?php

class TxtReport implements IReport {

    public function __construct($name, $dataArray) {
        $this->path = $this->setReportPath($name);
        print("\nEcriture du rapport...");
        $this->writeReport($this->path, $dataArray);
        print("\nVérification du rapport: \n");
        $this->readReport($this->path);
    }

    public function setReportPath($name) {
        $path = "./data/reports/txt" . $name . ".txt";
        return $path;
    }

    public function writeReport($path, $dataArray) {
        $reportFile = fopen($path, "w") or die("Impossible de créer le fichier dans la destination: " . $path); //will erase existing file of same name and destination if it exists - replace "w" with "x" if you want to launch an error if file already exists
        foreach ($dataArray as $newline) {
            fwrite($reportFile, $newline . "\n");
        }
        fclose($reportFile);
    }

    public function readReport($path) {
        $report = fopen($path, "r");
        print(fread($report, filesize($path)));
        fclose($report);
    }

}