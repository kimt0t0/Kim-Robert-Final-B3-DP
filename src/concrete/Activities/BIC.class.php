<?php

require_once '../../abstract/AActivity.php';

class ActivityBIC extends AActivity {
    public function __construct () {
        $this->activity = "BCN";
        $this->PAYERate = 50/100;
        $this->VFLRate = 1.7/100;
        $this->SSCRate = 12.8/100;
    }
}