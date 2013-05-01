<?php

/**
 * Testing the ClosestDate class
 *
 * @package  ClosestDate
 * @author   Alejandro Tabares <alex311es@gmail.com>
 */

class ClosestDateTest extends PHPUnit_Framework_TestCase
{
  public $closestDate;

  public function setUp()
  {

    date_default_timezone_set('Europe/Madrid');

    parent::setUp();
    $this->closestDate = new ClosestDate\ClosestDate;
  }

  /**
  * @dataProvider providerDates
  */
  public function testGetClosestDateFromCurrentDate($data, $correct)
  {
    $result = $this->closestDate->getClosestDate($data);
    $this->assertSame($result, $correct);
  }

  /**
  * @dataProvider providerDates
  */
  public function testGetClosestDateFromGivenDate($data, $correct)
  {
    $mode = ClosestDate\ClosestDate::PERIOD_ALL_DATES;
    $date = '2013-12-09';

    $result = $this->closestDate->getClosestDate($data, $mode, $date);
    $this->assertSame($result, $correct);
  }

  /**
  * @dataProvider pastDatesProvider
  */
  public function testGetClosestFromCurrentDateOnlyPastDates($data, $correct)
  {

    $mode = ClosestDate\ClosestDate::PERIOD_PAST_DATES;

    $result = $this->closestDate->getClosestDate($data, $mode);
    $this->assertSame($result, $correct);
  }

  /**
  * @dataProvider futureDatesProvider
  */
  public function testGetClosestFromCurrentDateOnlyFutureDates($data, $correct)
  {

    $mode = ClosestDate\ClosestDate::PERIOD_FUTURE_DATES;

    $result = $this->closestDate->getClosestDate($data, $mode);
    $this->assertSame($result, $correct);
  }

  public function providerDates()
  {

    $case1 = $this->pastDates();
    $case2 = $this->futureDates();
    $case3 = $this->pastAndFutureDates();

    return array(
      array($case1, '2012-09-01'),
      array($case2, '2050-04-01'),
      array($case3, '2013-02-01'),
    );
  }

  public function pastDatesProvider()
  {
    return array(
      array($this->pastDates(), '2012-09-01'),
    );
  }

  public function futureDatesProvider()
  {
    return array(
      array($this->futureDates(), '2050-04-01'),
    );
  }

  protected function pastDates()
  {
    return array(
      '2012-04-01',
      '2012-05-01',
      '2012-09-01',
    );

  }

  protected function futureDates()
  {
    return array(
      '2050-05-01',
      '2050-04-01',
      '2050-09-01',
      '2050-09-01',
    );

  }

  protected function pastAndFutureDates()
  {
    return array(
      '1999-04-01',
      '2013-02-01',
      '2050-09-01',
    );

  }

}
