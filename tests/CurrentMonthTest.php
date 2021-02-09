<?php

use PHPUnit\Framework\TestCase;

class CurrentMonthTest extends TestCase
{
    public function testCurrentMonthFileExists(): void
    {
        $this->assertFileExists(__DIR__ . '/../src/CurrentMonth.php', "You should have a /src/CurrentMonth.php file");
    }

    /**
     * @depends testCurrentMonthFileExists
     */
    public function testCurrentMonthClassExists(): void
    {
        require_once __DIR__ . '/../src/CurrentMonth.php';
        $this->assertTrue(class_exists("CurrentMonth"), "You should have a CurrentMonth class");
    }

    /**
     * @depends testCurrentMonthClassExists
     */
    public function testIsIncludedInPeriodExists(): CurrentMonth
    {
        $currentMonth = new CurrentMonth();
        $this->assertTrue(method_exists($currentMonth, "isIncludedInPeriod"), "You have to implement isIncludedInPeriod Method");
        return $currentMonth;
    }

    // Test si le premier jour du mois est posé
    public function testFirstDayOff(): void
    {
        $currentMonth = new CurrentMonth();
        $startAbsence = new DateTime('first day of this month 00:00:00');
        $endAbsence = new DateTime('first day of this month 23:59:59');
        $interval = new DateInterval('P1D');
        $absence = new DatePeriod($startAbsence, $interval, $endAbsence);
        $this->assertTrue($currentMonth->isIncludedInPeriod($absence), "You should get true when the first day of the month is off"); 
    }

    // Test si le dernier jour du mois est posé
    public function testLastDayOff(): void
    {
        $currentMonth = new CurrentMonth();
        $startAbsence = new DateTime('last day of this month 00:00:00');
        $endAbsence = new DateTime('last day of this month 23:59:59');
        $interval = new DateInterval('P1D');
        $absence = new DatePeriod($startAbsence, $interval, $endAbsence);
        $this->assertTrue($currentMonth->isIncludedInPeriod($absence), "You should get true when the last day of the month is off"); 
    }

    // Test si le dernier jour du mois précédent et le premier du mois en cours sont posés
    public function testBetweenCurrentAndPreviousMonth(): void
    {
        $currentMonth = new CurrentMonth();
        $startAbsence = new DateTime('last day of previous month 00:00:00');
        $endAbsence = new DateTime('first day of this month 23:59:59');
        $interval = new DateInterval('P1D');
        $absence = new DatePeriod($startAbsence, $interval, $endAbsence);
        $this->assertTrue($currentMonth->isIncludedInPeriod($absence), "You should get true when the days off are between previous and current month"); 
    }

    // Test si le dernier jour du mois en cours et le premier du suivant sont posés
    public function testBetweenCurrentAndNextMonth(): void
    {
        $currentMonth = new CurrentMonth();
        $startAbsence = new DateTime('last day of this month 00:00:00');
        $endAbsence = new DateTime('first day of next month 00:00:00');
        $interval = new DateInterval('P1D');
        $absence = new DatePeriod($startAbsence, $interval, $endAbsence);
        $this->assertTrue($currentMonth->isIncludedInPeriod($absence), "You should get true when the days off are between current and next month"); 
    }

    // Test si le dernier jour du mois précédent est posé
    public function testLastDayPreviousMonth(): void
    {
        $currentMonth = new CurrentMonth();
        $startAbsence = new DateTime('last day of previous month 00:00:00');
        $endAbsence = new DateTime('last day of previous month 23:59:59');
        $interval = new DateInterval('P1D');
        $absence = new DatePeriod($startAbsence, $interval, $endAbsence);
        $this->assertNotTrue($currentMonth->isIncludedInPeriod($absence), "You should get false when day is not included in current period"); 
    }

    // Test si le premier jour du mois suivant est posé
    public function testLastDayNextMonth(): void
    {
        $currentMonth = new CurrentMonth();
        $startAbsence = new DateTime('first day of next month 00:00:00');
        $endAbsence = new DateTime('first day of next month 23:59:59');
        $interval = new DateInterval('P1D');
        $absence = new DatePeriod($startAbsence, $interval, $endAbsence);
        $this->assertNotTrue($currentMonth->isIncludedInPeriod($absence), "You should get false when day is not included in current period"); 
    }

}