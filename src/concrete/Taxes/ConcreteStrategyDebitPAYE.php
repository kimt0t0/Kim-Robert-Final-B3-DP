<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */
require_once ABSPATH . './src/interfaces/StrategyDebit.php';
require_once ABSPATH . './src/concrete/Activities/ActivityFactoryConcrete.php';

/* CLASS */
// (PAYE = "Pay As You Earn" = prélèvement à la source)
class ConcreteStrategyDebitPAYE implements StrategyDebit {
    public function __construct($activityType, $turnoverET) {
        try {
            $this->turnoverET = $turnoverET;
            $this->activityFactory = new ActivityFactoryConcrete("paye", $activityType);
            $this->taxRate = $this->activityFactory->activityRates->getTaxRate();
            $this->sscRate = $this->activityFactory->activityRates->getSscRate();
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
        return $this->social;
    }
    
    public function getTax() {
        return $this->taxRate;
    }

    public function calculateTurnoverIT() {
        $this->turnoverIT = $this->turnoverET - $this->social;
        $this->taxableIncome = $this->turnoverET * (1 - $this->taxRate);
        $this->taxes = array($this->turnoverIT, $this->taxableIncome);
        return $this->taxes;
    }
}