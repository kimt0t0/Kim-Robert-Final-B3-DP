<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */
require_once ABSPATH . './src/interfaces/StrategyDebit.php';


/* CLASS */
// (PAYE = "Pay As You Earn" = prélèvement à la source)
class ConcreteStrategyDebitPAYE implements StrategyDebit {
    public function __construct($activityType, $turnoverET) {
        try {
            $this->activity = $activityType; //deletes spaces before/after
            $this->turnoverET = $turnoverET;
            
            switch ($this->activity) {
                case "BIC":
                    $this->taxRate = 50/100;
                    $this->sscRate = 12.8/100;
                case "BNC":
                    $this->taxRate = 34/100;
                    $this->sscRate = 22/100;
                case "BIC(Vente)":
                    $this->taxRate = 71/100;
                    $this->sscRate = 22/100;
            }
        }
        catch (exception $e) {
            echo "Il y a eu un problème lors du calcul de l'impôt:" . $e . PHP_EOL;
            return false;
        }
    }

    public function setDebitStrategy($strategy) {
        // setter pour changer de stratégie au runtime
    }

    public function getSSC() {
        $this->social = $this->turnoverET * $this->sscRate;
        print("\n- Cotisations sociales: " . $this->social);
    }
    
    public function getTaxRate() {
        print("\n- Taux d'imposition: " . $this->taxRate);
    }

    public function calculateTurnoverIT() {
        $this->turnoverIT = $this->turnoverET - $this->social;
        print("\n- CA TTC mensuel (revenu imposable)*: " . $this->turnoverIT);
    }
}