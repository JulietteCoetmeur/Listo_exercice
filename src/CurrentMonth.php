<?php

class CurrentMonth
{
    private $startDate;

    private $endDate;

    public function __construct()
    {
        $this->startDate = new \DateTime('first day of this month 00:00:00');
        $this->endDate = new \DateTime('first day of next month 00:00:00');
    }

    public function isIncludedInPeriod($absence):bool
    {
        foreach ($absence as $day) {
            if (($day >= $this->startDate) && ($day < $this->endDate)) {
                return true;
            }
        } 
        return false;
    }   
}