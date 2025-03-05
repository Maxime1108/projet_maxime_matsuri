<?php

namespace Services;

class Protect
{
    /**
     * Protéger les données contre les attaques XSS.
     *
     * @param mixed $mixed Les données à protéger (chaîne, tableau ou objet).
     * @return mixed Les données protégées.
     */
    public static function protectHtmlSpecialChars(mixed $mixed): mixed
    {
        if (is_array($mixed)) {
            // Protection des tableaux récursivement
            return array_map([self::class, 'protectHtmlSpecialChars'], $mixed);
        }

        if (is_object($mixed)) {
            // Protection des objets en itérant sur leurs propriétés accessibles
            foreach ($mixed as $property => $value) {
                $mixed->$property = self::protectHtmlSpecialChars($value);
            }
            return $mixed;
        }

        // Protection des chaînes
        return is_string($mixed) ? htmlspecialchars($mixed, ENT_QUOTES, 'UTF-8') : $mixed;
    }
}
