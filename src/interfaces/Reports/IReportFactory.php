<?php

interface IReportFactory {
    public function nameReport($userDataArray);
    public function createTxtReport($name, $dataArray); // I did not type my methods as the syntax causes an compilation error on my computer...
    public function createHtmlReport($name, $dataArray);
}