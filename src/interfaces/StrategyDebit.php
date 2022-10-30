<?php

interface StrategyDebit {
    public function setDebitStrategy($strategy);
    public function getSSC();
    public function getTaxRate();
    public function calculateTurnoverIT();
}