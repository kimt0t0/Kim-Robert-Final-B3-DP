<?php

interface IActivity {
    public function __construct();
    public function getTaxRate();
    public function getSscRate();
}