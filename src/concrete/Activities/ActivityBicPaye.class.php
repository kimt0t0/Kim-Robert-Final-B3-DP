<?php

class ActivityBicPaye implements IActivity {

    public function __construct() {
        $this->taxRate = 50/100;
        $this->sscRate = 12.8/100;
    }

    public function getTaxRate() {
        return $this->taxRate;
    }

    public function getSscRate() {
        return $this->sscRate;
    }
    
}