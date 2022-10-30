<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/* DEPENDENCIES */
require_once ABSPATH . './src/concrete/Activities/BIC.class.php';
require_once ABSPATH . './src/concrete/Activities/BICV.class.php';
require_once ABSPATH . './src/concrete/Activities/BNC.class.php';

// I created an abstract class so that if we want to create more specific cases of self-employment it will be easier
abstract class ASelfEmployee {

    public function __construct($index, $userArray) {
        
        $this->num = $index;

        $this->firstName = $userArray[0];
        $this->lastName = $userArray[1];
        $this->siret = $userArray[2];
        $this->activityType = $userArray[3];
        $this->debitType = $userArray[4];
        $this->turnoverET = $userArray[5];
    }

    public function __toString() {
        print("- Rapport numéro " . $this->num);
        print("\n- Nom: " . $this->lastName);
        print("\n- Prénom: " . $this->firstName);
        print("\n- SIRET: " . $this->siret);
        print("\n- Régime d activite: " . $this->activityType);
        print("\n- Type d'imposition: " . $this->debitType);
        print("\n- CA HT mensuel: " . $this->turnoverET);
        print("\n\n");
        return true;
    }

    public function checkSiret() {
        $siretSpaceless = trim($this->siret);
        $siretLength = strlen($siretSpaceless);
        if ($siretLength === 14) {
            return true;
        }
        else { return false; }
    }

    // public function getTaxRate() {
    //     try {
    //         switch ($this->activity) {
    //             case 
    //         }
    //         default: 
    //         echo "La valeur d'activité entrée n'est pas prise en compte par notre programme. Veuillez vérifier que vous n'avez pas commis d'erreur.\n Valeurs autorisées: ."
    //     }
    //     except (exception $e) {
    //         echo "Il y a eu un problème lors du calcul de l'impôt:" . $e . PHP_EOL;
    //         return false;
    //     }
    // }

    public function getSSCRate() {}

}