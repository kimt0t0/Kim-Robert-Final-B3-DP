<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */
require_once ABSPATH . './src/contexts/ContextDebit.class.php';
require_once ABSPATH . './src/concrete/Taxes/ConcreteStrategyDebitPAYE.php';
require_once ABSPATH . './src/concrete/Taxes/ConcreteStrategyDebitClassic.php';

// I created an abstract class so that if we want to create more specific cases of self-employment it will be easier
abstract class ASelfEmployee {

    public function __construct($index, $userArray) {
        
        $this->num = $index;

        $this->firstName = $userArray[0];
        $this->lastName = $userArray[1];
        $this->siret = trim($userArray[2]);
        $this->activityType = trim($userArray[3]);
        $this->debitType = trim($userArray[4]);
        $this->turnoverET = (int) $userArray[5];
    }

    public function storeUserInfo() {
        $myArray = $this->userInfo = array();
        
        $this->switchContextDebit ();
        
        $num=("- Rapport numéro " . $this->num);
        $lastName = ("- Nom: " . $this->lastName);
        $firstName = ("- Prénom: " . $this->firstName);
        $siret = ("- SIRET: " . $this->siret);
        $activityType = ("- Régime d activite: " . $this->activityType);
        $debitType = ("- Type d'imposition: " . $this->debitType);
        $turnoverET = ("- CA HT mensuel: " . $this->turnoverET);
        $social = ("- Cotisations sociales: " . $this->debitStrategy->getSSC());
        $tax = $this->debitStrategy->getTax();
        $turnoverIT = $this->debitStrategy->calculateTurnoverIT();
        
        array_push($myArray, $num, $lastName, $firstName, $siret, $activityType, $debitType, $turnoverET, $social, $tax, $turnoverIT);
        
        if($this->debitType === "Prélèvement à la source") {
            $additionalInfo = ("\n\n*Dans le cas du régime fiscal de prélèvement à la source, le montant de l'impôt n'est pas indiqué sur le CA TTC, il sera prélevé ultérieurement par le centre des impôts.");
            array_push($myArray, $additionalInfo);
        }

        return $myArray;
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

    // public function getSSCRate() {}

}