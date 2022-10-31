<?php

/* DEPENDENCIES */
require_once ABSPATH . './src/interfaces/Reports/IReport.php';
require_once ABSPATH . './src/interfaces/Reports/IReportFactory.php';
require_once ABSPATH . './src/concrete/Reports/TxtReport.class.php';
require_once ABSPATH . './src/concrete/Reports/HtmlReport.class.php';


/* CLASS */
class ReportFactoryConcrete implements IReportFactory {
    // I put some logic in the constructor here to automate these tasks but it compells us to automate
    //  the creation of a new factory for each line in the datafile.
    // You could instead choose to put all these actions in public methods, create only one factory and call 
    // the methods with new arguments for each line in the datafile.
    public function __construct($userDataArray) {
        $this->userDataArray = $userDataArray;
        $this->reportName = $this->nameReport($this->userDataArray);
        $this->txtReport = $this->createTxtReport($this->reportName, $this->userDataArray);
        // $this->htmlReport = $this->createHtmlReport($this->reportName, $this->userDataArray);
    }

    public function nameReport($userDataArray) {
        // générer nom
        $reportName = "test-report";
        return $reportName;
    }

    public function createTxtReport($name, $dataArray) {
        $this->txtReport = new TxtReport($name, $dataArray);
    }

    public function createHtmlReport($name, $dataArray) {
        $this->htmlReport = new HtmlReport($name, $dataArray);
    }

}