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
    public function __construct($userDataArray, $userDebitType) {
        $this->userDataArray = $userDataArray;
        $this->userDebitType = $userDebitType;
        $this->txtReport = $this->createTxtReport($this->userDataArray, $userDebitType);
        $this->htmlReport = $this->createHtmlReport( $this->userDataArray, $userDebitType);
    }

    public function createTxtReport($dataArray, $userDebitType) {
        $this->txtReport = new TxtReport($dataArray, $userDebitType);
    }

    public function createHtmlReport($dataArray, $userDebitType) {
        $this->htmlReport = new HtmlReport($dataArray, $userDebitType);
    }

}