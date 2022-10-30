<?php

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

require_once ABSPATH . './src/abstract/AActivity.php';

class ActivityBNC extends AActivity {
    public function __construct () {
        $this->activity = "BCN";
        $this->PAYERate = 34/100;
        $this->VFLRate = 2.2/100;
    }
}