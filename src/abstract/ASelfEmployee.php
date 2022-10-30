<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */
require_once ABSPATH . './src/concrete/Activities/ConcreteActivityBIC.class.php';
require_once ABSPATH . './src/concrete/Activities/ConcreteActivityBICV.class.php';
require_once ABSPATH . './src/concrete/Activities/ConcreteActivityBNC.class.php';

// I created an abstract class so that if we want to create more specific cases of self-employment it will be easier
abstract class ASelfEmployee {

    public function __construct($index, $userArray) {
        
        $this->num = $index;

        $this->firstName = $userArray[0];
        $this->lastName = $userArray[1];
        $this->siret = trim($userArray[2]);
        $this->activityType = trim($userArray[3]);
        $this->taxRates = $this->setTaxRates();
        $this->debitType = $userArray[4];
        $this->turnoverET = (int) $userArray[5];
    }

    public function __toString() {
        print("- Rapport numéro " . $this->num);
        print("\n- Nom: " . $this->lastName);
        print("\n- Prénom: " . $this->firstName);
        print("\n- SIRET: " . $this->siret);
        print("\n- Régime d activite: " . $this->activityType);
        print("\n- Taux d'imposition: " . $this->taxRates->PAYERate);
        print("\n- Type d'imposition: " . $this->debitType);
        print("\n- CA HT mensuel: " . $this->turnoverET);
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

    public function setTaxRates() {
        try {
            $activity = trim($this->activityType); //deletes spaces before/after

            switch ($activity) {
                case "BIC":
                    return new ConcreteActivityBIC();
                case "BNC":
                    return new ConcreteActivityBNC();
                case "BIC(Vente)":
                    return new ConcreteActivityBICV();
            }
        }
        catch (exception $e) {
            echo "Il y a eu un problème lors du calcul de l'impôt:" . $e . PHP_EOL;
            return false;
        }
    }

    // public function getSSCRate() {}

}