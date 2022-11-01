<?php

class ActivityBicClassic implements IActivity {

    public function __construct() {
        $this->taxRate = 1.7/100;
        $this->sscRate = 12.8/100;
    }

    public function getTaxRate() {
        return $this->taxRate;
    }

    public function getSscRate() {
        return $this->sscRate;
    }
    
}