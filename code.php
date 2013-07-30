<?php
$count = 0;
$parent = isset($parent) ? (integer) $parent : 0;
$published = isset($published) ? (bool) $published : true;
$deleted = isset($deleted) ? (bool) $deleted : false;
$delimeter = isset($delimeter) ? $delimeter : '|';
$dictonary = isset($dictonary) ? explode($delimeter, $dictonary) : false;
$modifier = isset($modifier) ? $modifier : 0;
$string_delimeter = isset($string_delimeter) ? $string_delimeter : ' ';

if ($parent > 0) {
  $criteria = array(
    'parent' => $parent,
    'deleted' => $deleted,
    'published' => $published,
  );
  $count = $modx->getCount('modResource', $criteria) - $modifier;
}

if(count($dictonary)){
  $count = (string) $count;
  $last_index = strlen($count)-1;
  $second_last_index = $last_index > 0 ? $last_index-1 : false;
  $last_symbol = $count[$last_index];

  if( ($second_last_index !== false && $count[$second_last_index] == 1) || $last_symbol == 0 || $last_symbol > 4 ){
    return (string) $count.$string_delimeter.$dictonary[2];
  }else if($last_symbol == 1){
    return (string) $count.$string_delimeter.$dictonary[0];
  }else if($last_symbol > 1 && $last_symbol < 5){
    return (string) $count.$string_delimeter.$dictonary[1];
  }
}

return (string) $count;