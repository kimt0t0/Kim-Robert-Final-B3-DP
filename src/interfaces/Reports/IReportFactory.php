<?php

interface IReportFactory {
    public function createTxtReport($dataArray, $userDebitType); // I did not type my methods as the syntax causes an compilation error on my computer...
    public function createHtmlReport($dataArray, $userDebitType);
}