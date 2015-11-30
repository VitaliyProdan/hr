<?php

namespace frontend\helpers;

use Yii;

class Utils
{
    public static function encodestring($string)
    {

        $translit = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',

            'й' => 'j',   'к' => 'k',    'и' => 'y',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'x',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',

            'ь' => '\'',  'ъ' => '\'\'',

            'э' => 'e\'',   'ю' => 'yu',  'я' => 'ya',

            'і' => 'i',   'ї' => 'yi',  'є' => 'ye',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',

            'Й' => 'J',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',

            'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',

            'Ь' => '\'',   'Ъ' => '\'\'',

            'Э' => 'E\'',   'Ю' => 'YU',  'Я' => 'YA',

            'І' => 'I',   'Ї' => 'Yi',  'Є' => 'Ye',
        );

        $lat = preg_match('/^[0-9A-Za-z]+$/', $string);
        if ($lat){
            return strtr($string, array_flip($translit));
        }else{
            return strtr($string, $translit);
        }
    }

    public static function progressColor($percents){
        if($percents){
            if ($percents >= 75){return 'success';}
            else if ($percents >= 50){return 'info';}
            else if ($percents >= 25){return 'warning';}
            else if ($percents >= 1){return 'danger';}
        }
    }

}