<?php
include_once 'rotor.php';
include_once 'reflector.php';

class Enigma
{
    private $rotores = array();
    private $reflector;

    function __construct($cant_r = 1, $n_r = 1, $n_ref = 1)
    {
        for ($i = 0; $i < $cant_r; $i++)
            $this->rotores[] = new Rotor($n_r);
        $this->reflector = new Reflectorr($n_ref);
    }
 
/*  
Adaptable a varios rotores, usamos uno porque el tp lo pide, por lo que hicimos el crackeador adaptado a un rotor solo. 
Podrían agregarse mas rotores desde el constructor pero el crackeador ya no funcionaría 
*/
    function codificar($msg, $init_pos = [])
    {
        if (is_string($msg)) {
            // Set Initial positions
            for ($i = 0; $i < count($init_pos); $i++)
                $this->rotores[$i]->set_posicion($init_pos[$i]);


            $msg_out = '';
            $l = '';
            for ($j = 0; $j < strlen($msg); $j++) {
                if ($msg[$j] == ' ') $l = ' ';
                else {
                    // RIGHT to LEFT
                    $rl = $msg[$j];
                    // echo "Letra $rl:\n";
                    for ($i = 0; $i < count($this->rotores); $i++) {
                        $rl = $this->rotores[$i]->right_to_left($rl);
                        // echo "Rotor $i: $rl\n";
                    }

                    // REFLECTOR
                    $ref = $this->reflector->reflejar($rl, $this->rotores[count($this->rotores) - 1]->get_posicion());
                    // echo "Reflector: $ref\n";

                    // LEFT to RIGHT
                    $lr = $ref;
                    for ($i = count($this->rotores) - 1; $i >= 0; $i--) {
                        $lr = $this->rotores[$i]->left_to_right($lr);
                        // echo "Rotor $i: $lr\n";
                    }

                    // ROTATIONS
                    $this->rotores[0]->girar_rotor();
                    for ($i = 0; $i < count($this->rotores) - 1; $i++) {
                        if ($this->rotores[$i]->get_posicion() >= 26) {
                            $this->rotores[$i]->set_posicion(0);
                            $this->rotores[$i + 1]->girar_rotor();
                        }
                    }
                    // OUTPUT
                    $l = $lr;
                    // echo "\n";
                }
                $msg_out .= $l;
            }
            return strtolower($msg_out);

            // Código anterior. Solo para un rotor (no array).
            /*
            $current_pos = $init_pos;
            $msg_out = '';
            $this->rotor->set_posicion($current_pos);

            for ($i = 0; $i < strlen($msg); $i++) {
                if ($msg[$i] != ' ') {
                    $lr = $this->rotor->right_to_left($msg[$i]);
                    $lref = $this->reflector->reflejar($lr, $current_pos);
                    $ll = $this->rotor->left_to_right($lref);
                    $current_pos = $this->rotor->girar_rotor();
                } else {
                    $ll = ' ';
                }
                $msg_out .= $ll;

                // echo 'In: ' . $msg[$i] . " RtL: $lr Ref: $lref LtR: $ll\n";
            } */
        }
    }
}
