<?php

require_once '../../abstract/AActivity.php';

class ActivityBICV extends AActivity {
    public function __construct () {
        $this->activity = "BCN";
        $this->PAYERate = 71/100;
        $this->VFLRate = 1/100;
    }

}