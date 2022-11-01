<?php

require_once ABSPATH . './src/interfaces/Reports/IReport.php';

class TxtReport implements IReport {

    public function __construct($dataArray) {
        $this->data = $dataArray;
        $this->reportName = $this->setReportName($this->data);
        $this->path = $this->setReportPath($this->reportName);
        print("\nEcriture du rapport...");
        $this->writeReport($this->path, $dataArray);
        print("\nVérification du rapport: \n");
        $this->readReport($this->path);
    }

    public function setReportName($data) {
        $num = str_replace(" ", "", $data[0]);
        $letter = str_replace(" ", "", $data[2][0]);
        $name = str_replace(" ", "", $data[1]);
        $reportName = strtolower($num . $letter . "-" . $name);
        return $reportName;
    }

    public function setReportPath($reportName) {
        $path = ABSPATH . "./data/reports/txt/" . $reportName . ".txt";
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