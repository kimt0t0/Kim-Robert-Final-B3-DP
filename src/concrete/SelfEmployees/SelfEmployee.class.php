<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */
require_once ABSPATH . './src/contexts/ContextDebit.class.php';
require_once ABSPATH . './src/concrete/Taxes/ConcreteStrategyDebitPAYE.php';
require_once ABSPATH . './src/concrete/Taxes/ConcreteStrategyDebitClassic.php';

// I created an abstract class so that if we want to create more specific cases of self-employment it will be easier
class SelfEmployee {

    public function __construct($index, $userArray) {
        
        $this->num = $index;

        $this->firstName = trim($userArray[0]);
        $this->lastName = trim($userArray[1]);
        $this->siret = trim($userArray[2]);
        $this->activityType = trim($userArray[3]);
        $this->debitType = trim($userArray[4]);
        $this->turnoverET = (int) $userArray[5];
    }

    public function checkSiret() {
        $siretSpaceless = $this->siret;
        $siretLength = strlen($siretSpaceless);
        if ($siretLength === 14) {
            return true;
        }
        else { return false; }
    }

    public function switchContextDebit () {
        switch ($this->debitType) {
            case "Prélèvement à la source": 
                return $this->debitStrategy = new ContextDebit(new ConcreteStrategyDebitPAYE($this->activityType, $this->turnoverET));
            case "Prélèvement libératoire": 
                return $this->debitStrategy = new ContextDebit(new ConcreteStrategyDebitClassic($this->activityType, $this->turnoverET));
        }
    }

    public function getUserInfo() {
        $dataArray = array();
        
        $this->switchContextDebit ();
        
        $num= $this->num;
        $lastName = $this->lastName;
        $firstName = $this->firstName;
        $siret = $this->siret;
        $activityType = $this->activityType;
        $tax = $this->debitStrategy->getTax();
        $social = $this->debitStrategy->getSSC();
        $turnoverIT = $this->debitStrategy->calculateTurnoverIT();
        $turnoverET = $this->turnoverET;
        
        array_push($dataArray, $num, $lastName, $firstName, $siret, $activityType, $turnoverET, $social, $turnoverIT, $tax);

        return $dataArray;
    }

}