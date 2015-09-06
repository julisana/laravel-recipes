<?php

namespace App\Helpers;

/**
 * Class StringHelpers
 * @package App\Helpers
 */
class StringHelpers
{
    protected function replaceSpecialCharacters($string, $regex = false, $encoding = "")
    {
        $new_string = '';

        $special_characters = $this->specialCharacters($encoding);

        if (!empty($encoding)) {
            $string = mb_convert_encoding($string, $encoding);
        }

        $split_string = str_split(trim($string));

        if ($regex) {
            foreach ($split_string as $key => $value) {
                if (isset($special_characters[$value]) && !empty($special_characters[$value])) {
                    $value = '[' . $value . implode('', $special_characters[$value]) . ']';
                }

                $new_string .= $value;
            }
        } else {
            foreach ($split_string as $key => $value) {
                $saved_character = false;

                foreach ($special_characters as $utf8_character => $international_characters) {
                    if (!empty($value) && in_array($value, $international_characters)) {
                        $new_string .= $utf8_character;
                        $saved_character = true;
                        break;
                    }
                }

                if (!$saved_character) {
                    $new_string .= $value;
                }
            }
        }

        if ($new_string != $string) {
            return mb_convert_encoding($new_string, "UTF-8");
        }

        return mb_convert_encoding($string, "UTF-8");
    }

    /**
     * Find ASCII-equivalents for language-specific characters. These are not meant to provide perfect
     * spelling equivalents, but to allow searching to be performed, so translations have been changed.
     * @link http://stackoverflow.com/questions/3371697/replacing-accented-characters-php
     *
     * @return string array
     */
    protected function specialCharacters($encoding = "")
    {
        $chars = [
            "'" => ['‘', '’', '‛'],
            '"' => ['“', '”', '‟'],
            'A' => ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ă', 'Ą'],
            'a' => ['à', 'á', 'â', 'ã', 'ä', 'å', 'ă', 'ą'],
            'B' => ['Þ'],
            'b' => ['þ'],
            'C' => ['Ç', 'Ć'],
            'c' => ['ç', 'ć'],
            'E' => ['È', 'É', 'Ê', 'Ë', 'Ę'],
            'e' => ['è', 'é', 'ê', 'ë', 'ę'],
            'f' => ['ƒ'],
            'G' => ['Ğ'],
            'g' => ['ğ'],
            'I' => ['Ì', 'Í', 'Î', 'Ï', 'İ', 'Į', 'Ĭ', 'Ī', 'Ĩ'],
            'i' => ['ì', 'í', 'î', 'ï', 'ı', 'į', 'ĭ', 'ī', 'ĩ'],
            'L' => ['Ł'],
            'l' => ['ł'],
            'N' => ['Ñ', 'Ń'],
            'n' => ['ñ', 'ń'],
            'O' => ['Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø'],
            'o' => ['ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ð'],
            'S' => ['Š', 'Ş', 'Ș', 'Ś'],
            's' => ['š', 'ș', 'ş', 'ś'],
            'T' => ['Ț'],
            't' => ['ț'],
            'U' => ['Ù', 'Ú', 'Û', 'Ü'],
            'u' => ['ù', 'ú', 'û', 'ü'],
            'Y' => ['Ý', 'Ÿ', 'Ŷ'],
            'y' => ['ý', 'ÿ', 'ŷ'],
            'Z' => ['Ž', 'Ż', 'Ź'],
            'z' => ['ž', 'ż', 'ź'],
        ];

        if (!empty($encoding)) {
            foreach ($chars as $simple_char => $international_chars) {
                foreach ($international_chars as $key => $value) {
                    $chars[$simple_char][$key] = mb_convert_encoding($value, $encoding);
                }
            }
        }

        return $chars;
    }
}
