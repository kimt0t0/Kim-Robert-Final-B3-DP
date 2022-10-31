<?php

interface IReport {
    public function setReportPath($name);
    public function writeReport($path, $dataArray); 
    public function readReport($path);
}