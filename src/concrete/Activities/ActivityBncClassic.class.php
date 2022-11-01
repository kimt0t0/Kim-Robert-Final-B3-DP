<?php

class ActivityBncClassic {

    public function __construct() {
        $this->taxRate = 34/100;
        $this->sscRate = 22/100;
    }

    public function getTaxRate() {
        return $this->taxRate;
    }

    public function getSscRate() {
        return $this->sscRate;
    }
    
}