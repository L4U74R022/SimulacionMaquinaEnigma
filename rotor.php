<?php

class Rotor
{
    private $ROTORES = ['EKMFLGDQVZNTOWYHXUSPAIBRCJ', 'AJDKSIRUXBLHWTMCQGZNPYFVOE', 'BDFHJLCPRTXVZNYEIWGAKMUSQO'];

    private $rotor;
    private $posicion;

    function __construct($n)
    {
        $this->posicion = 0;
        $this->rotor = array();
        $this->rotor_to_array($this->ROTORES[$n - 1]);
    }
    function set_posicion($p)
    {
        $this->posicion = $p;
    }
    function get_posicion()
    {
        return $this->posicion;
    }

    private function rotor_to_array($array)
    {
        $l = 'A';
        $a = [];
        for ($i = 0; $i < strlen($array); $i++) {
            $a[$l++] = $array[$i];
        }
        // var_dump($a);
        $this->rotor = $a;
        // $l = 'A';
        // for ($i = 0; $i < 26; $i++) {
        //     $this->rotor[$l++] = $this->ROTORES[$n - 1][$i];
        // }
        // var_dump($this->rotor);
    }

    function girar_rotor()
    {
        array_push($this->rotor, array_shift($this->rotor));
        $this->posicion++;
        $this->rotor_to_array(implode($this->rotor));
        return $this->posicion;
        // var_dump($this->rotor);
    }
    /*
    Right es la entrada del teclado
    Left es el siguiente Rotor o Reflector */
    function right_to_left($l)
    {
        if (is_string($l) && strlen($l) == 1) {
            $l_out = $this->rotor[strtoupper($l)];
            return $l_out;
        }
    }

    function left_to_right($l)
    {
        if (is_string($l) && strlen($l) == 1) {
            foreach ($this->rotor as $index => $value) {
                if (strcmp($l, $value) == 0) {
                    return $index;
                }
            }
        }
    }
}
