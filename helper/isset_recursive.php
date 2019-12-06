<?php

/**
 * Рекурсивная проверка существования ключей в массиве
 *
 * @param array $array          Исходный массив
 * @param array $nestedKeyList  Список ключей в порядке вложенности
 * @example (['data' => ['id' => []]], ['data', 'id']) => true
 *
 * @return bool
 */
$issetRecursive = function (array $array, array $nestedKeyList) {
    $checkArray = $array;
    foreach ($nestedKeyList as $nestedKey) {
        $checkList = is_array($nestedKey) ? $nestedKey : [$nestedKey];
        foreach ($checkList as $checkKey) {
            if (!isset($checkArray[$checkKey])) {
                return false;
            }
        }
        $checkArray = $checkArray[array_pop($checkList)];
    }

    return true;
};

/* ------------------------------------------------------------------------------------------------------------------ */

$assertTrue = function ($result) { echo $result ? '&radic;' : '-'; };

$assertTrue($issetRecursive(['data' => []], ['data']));
$assertTrue(!$issetRecursive(['data' => []], ['items']));
$assertTrue($issetRecursive(['data' => ['id' => []]], ['data', 'id']));
$assertTrue($issetRecursive(['data' => ['id' => ['key' => []]]], ['data', 'id']));
$assertTrue(!$issetRecursive(['items' => ['id' => []]], ['items', 'name']));
$assertTrue($issetRecursive(['data' => ['id' => [], 'count' => []]], ['data', ['id', 'count']]));
$assertTrue(!$issetRecursive(['items' => ['id' => [], 'name' => []]], ['data', ['id', 'name', 'count']]));