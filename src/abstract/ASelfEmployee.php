<?php

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
        print("- Nom: " . $this->lastName);
        print("- Prénom: " . $this->firstName);
        print("SIRET: " . $this->siret);
        print("- Régime d activite: " . $this->activityType);
        print("- Type d'imposition: " . $this->debitType);
        print("- CA HT mensuel: " . $this->turnoverET);
        return true;
    }

    // public function calculateTurnoverIT() {
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

}