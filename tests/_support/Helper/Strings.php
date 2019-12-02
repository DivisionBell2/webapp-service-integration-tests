<?php
/**
 * @description Утилиты для работы со строками
 */

namespace Helper;

class Strings
{
    public static function areStringsEqualCi(string $string1, string $string2, string $encoding = 'UTF-8'): bool
    {
        return mb_strtolower($string1, $encoding) == mb_strtolower($string2, $encoding);
    }

    /**
     * @description Возвращает bool в зависимости от того, найдено ли вхождение строки `$needle` в стоге `$haystack`.
     *  Если `$haystack` является массивом, то true вернётся, если `$needle` найдена хотя бы в одной из строк массива.
     *  Поиск чувствителен к регистру.
     * @param  string          $needle      Example: 'lol'
     * @param  string|string[] $haystack    Example: 'Trololololo-lololo-lololo' | ['Trolo', 'Trololo', 'Trolololo']
     * @return bool            Возвращает true, если вхождение найдено, иначе false.
     */
    public static function isStringFoundIn(string $needle, $haystack): bool
    {
        if (is_array($haystack)) {
            // Ищем вхождение подстроки хотя бы в одной строке массива $haystack
            foreach ($haystack as $string) {
                if (strpos($string, $needle) !== false) {
                    return true;
                }
            }
            return false;
        } else {
            // Ищем вхождение подстроки в строке $haystack
            return strpos($haystack, $needle) !== false;
        }
    }
}
