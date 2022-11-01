<?php

require_once ABSPATH . './src/interfaces/Reports/IReport.php';

class TxtReport implements IReport {

    public function __construct($dataArray, $userDebitType) {
        $this->data = $dataArray;
        $this->reportName = $this->setReportName($this->data);
        $this->path = $this->setReportPath($this->reportName);
        $this->userDebitType = $userDebitType;
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

    public function writeReport($path, $data) {
        $reportFile = fopen($path, "w") or die("Impossible de créer le fichier dans la destination: " . $path); //will erase existing file of same name and destination if it exists - replace "w" with "x" if you want to launch an error if file already exists
        fwrite($reportFile, "- Rapport numéro " . $data[0]);
        fwrite($reportFile, "\n- Nom: " . $data[1]);
        fwrite($reportFile, "\n- Prénom: " . $data[2]);
        fwrite($reportFile, "\n- SIRET: " . $data[3]);
        fwrite($reportFile, "\n- Régime d activité: " . $data[4]);
        fwrite($reportFile, "\n- CA HT mensuel: " . $data[5] . "€");
        fwrite($reportFile, "\n- Cotisations sociales: " . $data[6] . "€");
        if ($this->userDebitType === "Prélèvement à la source") {
            fwrite($reportFile, "\n- Revenu imposable: " . $data[7][1] . "€");
            fwrite($reportFile, "\n- CA TTC mensuel*: " . $data[7][0] . "€");
            fwrite($reportFile, "\n*Dans le cas du régime fiscal de prélèvement à la source, le montant de l'impôt n'est pas indiqué sur le CA TTC, il sera prélevé ultérieurement par le centre des impôts.");

        }
        else if ($this->userDebitType === "Prélèvement libératoire") {
            fwrite($reportFile, "\n- CA TTC mensuel: " . $data[7] . "€");
        }
        else {
            fwrite($reportFile, "\n\nATTENTION: Type de prélèvement non reconnu par notre logiciel. Le calcul n a pas pu être finalisé.");
        }
        fclose($reportFile);
    }

    public function readReport($path) {
        $report = fopen($path, "r");
        print(fread($report, filesize($path)));
        fclose($report);
    }

}