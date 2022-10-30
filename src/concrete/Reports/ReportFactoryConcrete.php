<?php

/* DEPENDENCIES */
require_once ABSPATH . './src/interfaces/IReportFactory.php';
require_once ABSPATH . './src/concrete/Reports/TxtReport.class.php';
require_once ABSPATH . './src/concrete/Reports/PdfReport.class.php';


/* CLASS */
class ReportFactoryConcrete implements IReportFactory {


    public function nameReport() {
        return $this->reportName;
    }

    public function createTxtReport() {
        $this->txtReport = new TxtReport($this->reportName);
    }

    public function createPdfReport() {
        $this->pdfReport = new PdfReport($this->reportName);
    }

}