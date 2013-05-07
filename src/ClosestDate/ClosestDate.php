<?php

namespace ClosestDate;

class ClosestDate
{
  const PERIOD_PAST_DATES    = 1;
  const PERIOD_FUTURE_DATES  = 2;
  const PERIOD_ALL_DATES     = 4;

  public function getClosestDate($dates, $mode = self::PERIOD_ALL_DATES, $date = NULL)
  {
    switch ($mode) {
      case self::PERIOD_PAST_DATES:
      case self::PERIOD_FUTURE_DATES:
        $method = 'getClosestDateOnlyPastOfFutureDates';
        break;

      default:
        $method = 'getClosestDateAllDates';
        break;
    }

    $time = $date ? strtotime($date) : time();
    $result = $this->{$method}($dates, $time);

    return $result;
  }

  /**
  *
  */
  protected function getClosestDateOnlyPastOfFutureDates($dates, $time)
  {

    $min_diff = $time;

    foreach ($dates as $key => $date) {

      $diff = $time - strtotime($date);

      $abs_diff = abs($diff);

      if ($abs_diff < $min_diff) {
        $min_diff = $abs_diff;
        $closest_date_key = $key;
      }

    }

    return $dates[$closest_date_key];
  }

  /**
  *
  */
  protected function getClosestDateAllDates($dates, $time)
  {

    $min_diff = $time;
    $have_past_dates = FALSE;

    foreach ($dates as $key => $date) {

      $diff = $time - strtotime($date);

      if (!$have_past_dates && $diff > 0) {
        $have_past_dates = TRUE;
      }

      if ($have_past_dates && $diff < 0) {
        break;
      }

      $abs_diff = abs($diff);

      if ($abs_diff < $min_diff) {
        $min_diff = $abs_diff;
        $closest_date_key = $key;
      }

    }

    return $dates[$closest_date_key];
  }

}
