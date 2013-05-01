<?php

namespace NearestDate;

class NearestDate {

  const PERIOD_PAST_DATES    = 1;
  const PERIOD_FUTURE_DATES  = 2;
  const PERIOD_ALL_DATES     = 4;

  public function getNearestDate($dates, $mode = self::PERIOD_ALL_DATES)
  {

    $result = $this->getNearestDateAllDates($dates);
    return $result;
  }

  /**
  *
  */
  protected function getNearestDateAllDates($dates)
  {

    $min_diff = time();
    $tengo_condiciones_anteriores_a_hoy = FALSE;

    foreach ($dates as $key => $date) {

      $tiempo_inicio_condicion = strtotime($date);
      $diff = time() - $tiempo_inicio_condicion;

      if(!$tengo_condiciones_anteriores_a_hoy && $diff > 0)
      {
        $tengo_condiciones_anteriores_a_hoy = TRUE;
      }

      if($tengo_condiciones_anteriores_a_hoy && $diff < 0){
        break;
      }

      $abs_diff = abs($diff);

      if($abs_diff < $min_diff){
        $min_diff = $abs_diff;
        $nearest_date_key = $key;
      }

    }
    return $dates[$nearest_date_key];
  }

}
