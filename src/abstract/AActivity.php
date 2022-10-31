<?php

// This abstract class could have been used for an activity types factory - in this project this file is useless
// I just left it so you can see I got the idea
abstract class AActivity {
    public function __construct() {}

    // ***** Same implementation in every subclass (the specific values will be defined in variables the constructor of every activity subclass):

    // PAYE <-> Pay As You Earn <-> prélèvement à la source
    public function getPAYERate () {
        return $this->PAYERate;
    }

    public function getVFLRate() {
        return $this->VFLRate;
    }

     // SSC = Social Security Contribution
    public function getSSCRate() {
        return $this->SSCRate;
    }

}