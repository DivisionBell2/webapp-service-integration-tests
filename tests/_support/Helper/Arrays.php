<?php
/**
 * @description Утилиты для работы с массивами
 */

namespace Helper;

class Arrays
{
    public static function checkForEmptyArray(
        array $targetArray,
        string $errorText = 'Массив пустой',
        bool $throwExceptionIfEmpty = true
    ) {
        if (count($targetArray) < 1) {
            if ($throwExceptionIfEmpty) {
                throw new \Exception($errorText);
            }
        }
    }
}
