<?php

class Util
{
    /**
     * Gera um password aleatorio
     *
     * @param integer $length
     * @return string
     */
    static public function generatePassword($length = 8)
    {
        $vowels = 'aeuy';
        $vowels.= '1234567890';
        $consonants = 'bdghjmnpqrstvz';


        $password = '';

        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }

        return $password;
    }

    public static function generateSlug($phrase, $maxLength = 100)
    {
        $result = strtolower($phrase);

        $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
        $result = trim(preg_replace("/[\s-]+/", " ", $result));
        $result = trim(substr($result, 0, $maxLength));
        $result = preg_replace("/\s/", "_", $result);

        return $result;
    }
}

?>
