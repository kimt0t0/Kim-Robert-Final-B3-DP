<?php

interface StrategyDebit {
    public function setDebitStrategy($strategy);
    public function getSSC();
    public function getTax();
    public function calculateTurnoverIT();
}