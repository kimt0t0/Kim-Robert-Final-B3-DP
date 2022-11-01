<?php

interface IReportFactory {
    public function createTxtReport($dataArray); // I did not type my methods as the syntax causes an compilation error on my computer...
    public function createHtmlReport($dataArray);
}