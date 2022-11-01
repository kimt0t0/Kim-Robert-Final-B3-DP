<?php

interface IReport {
    public function __construct($dataArray, $userDebitType);
    public function setReportName($data);
    public function setReportPath($name);
    public function writeReport($path, $dataArray); 
    public function readReport($path);
}