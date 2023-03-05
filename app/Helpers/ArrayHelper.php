<?php

namespace App\Helpers;

class ArrayHelper
{
  public static function sort_array(array &$array, string $array_sortable_field, $sort)
  {
    $sort_order = strtoupper($sort);

    if (!in_array($sort_order, ['ASC', 'DESC'])) {
      throw new \InvalidArgumentException('O Valor passado para o tipo de ordenação está incorreto!');
    }

    usort($array, function ($a, $b) use ($array_sortable_field, $sort_order) {
      if (!isset($a[$array_sortable_field])) {
        throw new \InvalidArgumentException('O Valor passado para a chave a ser ordenada está incorreto!');
      }

      if ($sort_order == 'DESC') {
        return $a[$array_sortable_field] < $b[$array_sortable_field];
      } else {
        return $a[$array_sortable_field] > $b[$array_sortable_field];
      }
    });
  }
}
