<?php

/**
 * Testing the NearestDate class
 *
 * @package  NearestDate
 * @author   Alejandro Tabares <alex311es@gmail.com>
 */

class NearestDateTest extends PHPUnit_Framework_TestCase
{
  public $nearestDate;

  public function setUp()
  {

    date_default_timezone_set('Europe/Madrid');

    parent::setUp();
    $this->nearestDate = new \NearestDate\NearestDate;
  }

  /**
  * @dataProvider providerDates
  */
  public function testGetNearestDate($data, $correct){

    $result = $this->nearestDate->getNearestDate($data);
    $this->assertSame($result, $correct);
  }

  public function providerDates()
  {

    // solo fechas pasadas el bueno es el 2
    $case1 = array(
      '2012-04-01',
      '2012-05-01',
      '2012-09-01',
      '2011-09-01',
      '2010-09-01',
      '1970-09-01',
    );

    // solo fechas futuras el bueno es el 1
    $case2 = array(
      '2014-05-01',
      '2014-04-01',
      '2014-09-01',
      '2018-09-01',
    );

    // fechas pasadas y futuras el bueno es el 1
    $case3 = array(
      '2012-04-01',
      '2013-02-01',
      '2014-09-01',
    );

    return array(
      array($case1, '2012-09-01'),
      array($case2, '2014-04-01'),
      array($case3, '2013-02-01'),
    );
  }

}
