<?php

interface IReport {
    public function setReportName($data);
    public function setReportPath($name);
    public function writeReport($path, $dataArray); 
    public function readReport($path);
}