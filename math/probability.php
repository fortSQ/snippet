<?php

/**
 * Соотношения, в которые делятся события
 */
$events = [
    'a' => 1,
    'b' => 2,
    'c' => 1,
];

$get = function ($events) {
    // случайное число в диапазоне всех соотношений
    $random = mt_rand(1, array_sum($events));

    // в какую именно границу попадает событие
    $value = 0;
    foreach ($events as $event => $frequency) {
        $value += $frequency;
        if ($random <= $value) {
            return $event;
        }
    }
};

$test = 1000;
$arr = [];
for ($i = 1; $i <= $test; $i++) {
    $event = $get($events);
    // запоминаем кол-во выпадающих событий
    if (!isset($arr[$event])) {
        $arr[$event] = 0;
    }
    $arr[$event]++;
}
// выводим сводную таблицу - статистику в процентах
$arr = array_map(function ($value) use ($test) {
    return $value / $test * 100 . '%';
}, $arr);

ksort($arr);
echo '<pre>';
print_r($arr);
echo '</pre>';