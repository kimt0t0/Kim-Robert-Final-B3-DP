<?php
// NB: ET <-> excluding taxes // IT <-> including taxes

abstract class AReport {

    public function __construct($index) {
        $this->identifier = $index;

        $this->identity = $this->getIdentity();
        $this->activity = $this->getActivity();
        $this->turnoverET = $this->getTurnoverET();
        $this->tax = $this->calculateTax();
        $this->turnoverIT = $this->getTurnoverIT();
    }

    protected function getIdentity() {}

    protected function getActivity() {}

    protected function getTurnoverET() {}

    protected function calculateTax() {}

    protected function getTurnoverIT() {}

    public function createReport() {
        // Devra faire appel à des classes liées à une interface - on doit pouvoir ajouter des formats.
    }

}