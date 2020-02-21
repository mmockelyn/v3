<?php
/**
 * Created by IntelliJ IDEA.
 * User: Sylth
 * Date: 22/01/2020
 * Time: 13:04
 */

namespace App\HelpersClass;


use Illuminate\Support\Str;

class Generator
{
    /**
     * Permet de générer un mot de passe aléatoire à 8 caractères alphanumérique
     *
     * @return string
     */
    public static function createPassword()
    {
        return Str::random(8);
    }

    /**
     * Permet de formater un nombre floatant en devise locale
     *
     * @param float $value
     * @param string $currency
     * @return string
     */
    public static function formatCurrency($value, $currency = "euro")
    {
        switch($currency)
        {
            case "euro":
                return number_format($value, 2, ',', ' ')." €";
            case "dollard":
                return number_format($value, 2, ',', ' ')." $";
            default:
                return number_format($value, 2, ',', ' ')." €";
        }
    }

    /**
     * Permet de formater un texte au pluriels
     *
     * @param string $string
     * @param int $count
     * @return string
     */
    public static function formatPlural(string $string, int $count)
    {
        if($count > 1){
            return $string.'s';
        }else{
            return $string;
        }
    }

    /**
     * Permet de définir si une route est active ou non
     * TODO: Pensez à le parametrer à chaque initialisation de projet
     *
     * @param array ...$routes
     * @return string|null
     */
    public static function currentRoute(...$routes)
    {
        foreach ($routes as $route){
            if(request()->url() == $route){
                return "kt-menu__item--here";
            }else{
                return null;
            }
        }
        return null;
    }

    public static function firsLetter(string $word, $length = 1)
    {
        if($length == 1) {
            return Str::limit($word, 1, null);
        }else {
            return Str::limit($word, $length, null);
        }
    }

}
