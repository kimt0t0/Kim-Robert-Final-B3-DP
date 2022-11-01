<?php

class HtmlReport implements IReport {

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
        $path = ABSPATH . "./data/reports/html/" . $reportName . ".html";
        return $path;
    }

    public function writeReport($path, $data) {
        $reportFile = fopen($path, "w") or die("Impossible de créer le fichier dans la destination: " . $path); //will erase existing file of same name and destination if it exists - replace "w" with "x" if you want to launch an error if file already exists
        fwrite($reportFile, "<html><body>");
        fwrite($reportFile, "\n<h1>Rapport numéro " . $data[0] . "</h1>");
        fwrite($reportFile, "\n<ul>");
        fwrite($reportFile, "\n<li>Nom: " . $data[1] . "</li>");
        fwrite($reportFile, "\n<li>Prénom: " . $data[2] . "</li>");
        fwrite($reportFile, "\n<li>SIRET: " . $data[3] . "</li>");
        fwrite($reportFile, "\n<li>Régime d activité: " . $data[4] . "</li>");
        fwrite($reportFile, "\n<li>CA HT mensuel: " . $data[5] . "€" . "</li>");
        fwrite($reportFile, "\n<li>Cotisations sociales: " . $data[6] . "€" . "</li>");
        if ($this->userDebitType === "Prélèvement à la source") {
            fwrite($reportFile, "\n<li>Revenu imposable: " . $data[7][1] . "€" . "</li>");
            fwrite($reportFile, "\n<li>CA TTC mensuel*: " . $data[7][0] . "€" . "</li>");
            fwrite($reportFile, "\n</ul>");
            fwrite($reportFile, "\n<small>*Dans le cas du régime fiscal de prélèvement à la source, le montant de l'impôt n'est pas indiqué sur le CA TTC, il sera prélevé ultérieurement par le centre des impôts.</small>");

        }
        else if ($this->userDebitType === "Prélèvement libératoire") {
            fwrite($reportFile, "\n<li>CA TTC mensuel: " . $data[7] . "€" . "</li>");
            fwrite($reportFile, "\n</ul>");
        }
        else {
            fwrite($reportFile, "\n\nATTENTION: Type de prélèvement non reconnu par notre logiciel. Le calcul n a pas pu être finalisé.");
        }
        fwrite($reportFile, "\n</html></body>");
        fclose($reportFile);
    }

    public function readReport($path) {
        $report = fopen($path, "r");
        print(fread($report, filesize($path)));
        fclose($report);
    }

}