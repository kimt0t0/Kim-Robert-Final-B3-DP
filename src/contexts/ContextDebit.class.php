<?php

class ContextDebit {
    private $strategy;

    public function __construct(StrategyDebit $strategy) {
        $this->strategy = $strategy;
    }

    // May be useful if user changes debit type, or if we want to change it at runtime
    public function setDebitStrategy(StrategyDebit $strategy) {
        $this->strategy = $strategy;
    }

    public function getSSC() {
        $social= $this->strategy->getSSC();
    }

    public function getTax() {
        $taxRate = $this->strategy->getTax();
    }

    public function calculateTurnoverIT() {
        $turnoverIt = $this->strategy->calculateTurnoverIT();
    }
    
}