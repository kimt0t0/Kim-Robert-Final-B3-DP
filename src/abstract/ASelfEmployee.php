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

    public function __toString() {
        print("- Rapport numéro " . $this->num);
        print("\n- Nom: " . $this->lastName);
        print("\n- Prénom: " . $this->firstName);
        print("\n- SIRET: " . $this->siret);
        print("\n- Régime d activite: " . $this->activityType);
        print("\n- Type d'imposition: " . $this->debitType);
        print("\n- CA HT mensuel: " . $this->turnoverET);
        $this->switchContextDebit ();
        $this->debitStrategy->getSSC();
        $this->debitStrategy->getTaxRate();
        $this->debitStrategy->calculateTurnoverIT();
        
        if($this->debitType === "Prélèvement à la source") {
            print("\n*Dans le cas du régime fiscal de prélèvement à la source, le montant de l'impôt n'est pas indiqué sur le CA TTC, il sera prélevé ultérieurement par le centre des impôts.");
        }
        else {}
        
        print("\n\n");
        return true;
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