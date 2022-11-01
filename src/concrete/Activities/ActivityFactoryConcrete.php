<?php

/* DEPENDENCIES */ 
require_once ABSPATH . './src/interfaces/Activities/IActivity.php';
require_once ABSPATH . './src/interfaces/Activities/IActivityFactory.php';

require_once ABSPATH . './src/concrete/Activities/ActivityBicPaye.class.php';
require_once ABSPATH . './src/concrete/Activities/ActivityBicVPaye.class.php';
require_once ABSPATH . './src/concrete/Activities/ActivityBncPaye.class.php';
require_once ABSPATH . './src/concrete/Activities/ActivityBicClassic.class.php';
require_once ABSPATH . './src/concrete/Activities/ActivityBicVClassic.class.php';
require_once ABSPATH . './src/concrete/Activities/ActivityBncClassic.class.php';



/* CLASS */
class ActivityFactoryConcrete implements IActivityFactory {

    public function __construct($taxType, $activityType) {
        $this->activityType = $activityType;
        switch ($taxType) {
            case "paye":
                switch ($this->activityType) {
                    case "BIC": 
                        return $this->activityRates = new ActivityBicPaye();
                    case "BIC(Vente)": 
                        return $this->activityRates = new ActivityBicVPaye();
                    case "BNC": 
                        return $this->activityRates = new ActivityBncPaye();
                }
            case "classic":
                switch ($this->activityType) {
                    case "BIC": 
                        return $this->activityRates = new ActivityBicClassic();
                    case "BIC(Vente)":
                        return $this->activityRates = new ActivityBicVClassic();
                    case "BNC":
                        return $this->activityRates = new ActivityBncClassic();
                }
        }
    }

    public function getTaxRate() {
        return $this->activityRates->taxRate;
    }

    public function getSscRate() {
        return $this->activityRates->sscRate;
    }
}