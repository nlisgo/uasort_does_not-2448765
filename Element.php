<?php

class Element
{
  public static function children(array &$elements, $sort = FALSE) {
    // Do not attempt to sort elements which have already been sorted.
    $sort = isset($elements['#sorted']) ? !$elements['#sorted'] : $sort;

    // Filter out properties from the element, leaving only children.
    $children = array();
    $sortable = FALSE;
    foreach ($elements as $key => $value) {
      if ($key === '' || $key[0] !== '#') {
        if (is_array($value)) {
          $children[$key] = $value;
          if (isset($value['#weight'])) {
            $sortable = TRUE;
          }
        }
        // Only trigger an error if the value is not null.
        // @see http://drupal.org/node/1283892
        elseif (isset($value)) {
          // trigger_error(String::format('"@key" is an invalid render array key', array('@key' => $key)), E_USER_ERROR);
        }
      }
    }
    // Sort the children if necessary.
    if ($sort && $sortable) {
      $children = array_reverse($children);
      uasort($children, 'self::sortByWeightProperty');
      // Put the sorted children back into $elements in the correct order, to
      // preserve sorting if the same element is passed through
      // \Drupal\Core\Render\Element::children() twice.
      foreach ($children as $key => $child) {
        unset($elements[$key]);
        $elements[$key] = $child;
      }
      $elements['#sorted'] = TRUE;
    }

    return array_keys($children);
  }

  public static function sortByWeightProperty($a, $b) {
    return static::sortByKeyInt($a, $b, '#weight');
  }

  public static function sortByKeyInt($a, $b, $key) {
    $a_weight = (is_array($a) && isset($a[$key])) ? $a[$key] : 0;
    $b_weight = (is_array($b) && isset($b[$key])) ? $b[$key] : 0;

    if ($a_weight == $b_weight) {
      return 0;
    }

    return ($a_weight < $b_weight) ? -1 : 1;
  }
}
