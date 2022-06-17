<?php

$t = strtotime('10:00');
$max = 12.5 * 60;
$times = [];
for($i = 0; $i < $max; $i += 30) {
  $time = date('H:i', strtotime("+{$i} minutes", $t));
  array_push($times, $time);
}
return [
  'times' => $times
];