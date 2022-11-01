<?php

interface IActivityFactory {
    public function __construct($taxType, $activityType);
    public function getTaxRate();
    public function getSscRate();
}