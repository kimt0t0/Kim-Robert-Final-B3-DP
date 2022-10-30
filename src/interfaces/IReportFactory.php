<?php

require_once ABSPATH . './src/interfaces/IReport.php';

interface IReportFactory {
    public function nameReport();
    public function createTxtReport(); // I did not type my methods as the syntax causes an compilation error on my computer...
    public function createPdfReport();
}