<?php

class Reflectorr
{
    private $REFLECTORES = ['YRUHQSLDPXNGOKMIEBFZCWVJAT'];

    private $reflector;

    function __construct($n)
    {
        $this->setup_reflector($n);
    }

    private function setup_reflector($n)
    {
        $l = 'A';
        $r = $this->REFLECTORES[$n - 1];

        for ($i = 0; $i < strlen($r); $i++) {
            $offset = ord($r[$i]) - ord($l);

            $this->reflector[$l] = $offset;
            $l++;
        }
        // var_dump($this->reflector);
    }
    function cesar_code($text, $key)
    {
        if ($key < 0) $key = 26 + $key;
        $letra = $text;
        for ($j = 0; $j < $key; $j++) {
            $letra = ++$letra;
            if ($letra == 'aa') $letra = 'a';
            if ($letra == 'AA') $letra = 'A';
        }
        return $letra;
    }

    // $n es un char
    function reflejar($n, $rotor_pos)
    {
        if (is_string($n) && strlen($n) == 1) {
            $offset = $this->cesar_code($n, 26 - $rotor_pos);

            return $this->cesar_code(
                $n,
                $this->reflector[strtoupper($offset)]
            );
        }
        // return $xd;
    }
}
