<?php

namespace App\Helpers;

class ArrayHelper
{
  public static function sort_array(array &$array, string $array_sortable_field, $sort)
  {
    if ($sort == 'desc') {
      usort($array, function ($a, $b) use ($array_sortable_field){
        return $a[$array_sortable_field] < $b[$array_sortable_field];
      });
    } else {
      usort($array, function ($a, $b) use ($array_sortable_field) {
        return $a[$array_sortable_field] > $b[$array_sortable_field];
      });
    }
  }
}
