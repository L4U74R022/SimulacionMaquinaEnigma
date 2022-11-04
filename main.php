<?php

include_once 'enigma.php';
$dicc = file("diccionario.txt", FILE_IGNORE_NEW_LINES);
$input = readline("Ingresar Mensaje a Cifrar: ");
$posinicial_rotor=readline("Ingresar Posición inicial del rotor: ");

$enigma = new Enigma();
echo "Mensaje cifrado: ".$enigma->codificar($input,[$posinicial_rotor]);




// $search = 'abyn'; // Hola mundo codificado en posicion inicial 25



// $brute_force = crack($search);
// echo "Frase decodificada: " . $brute_force[0] . "\n";
// echo "Posición inicial del rotor: " . $brute_force[1] . "\n";

function buscar($e, $dicc)
{
    for ($i = 0; $i < count($dicc); $i++) {
        if ($dicc[$i] == $e) {
            return 1;
        }
    }
    return -1;
}

//Función que realiza la fuerza bruta 
function crack($text)
{
    global $dicc;
    $text_decoded = "";
    $code = 0;

    /* Estas  palabras, las buscamos en el diccionario */
    for ($n = 0; $n < 27; $n++) {

        $enigma = new Enigma();
        $buscar = $enigma->codificar($text, [$n]);

        $ar_text = explode(' ', $buscar);
        for ($i = 0; $i < count($ar_text); $i++) {

            if (buscar($ar_text[$i], $dicc) != -1) {
                $code = $n;
                break 2;
            }
        }
    }
    $enigma = new Enigma();
    $text_decoded = $enigma->codificar($text, [$code]);

    $return = [];
    $return[] = $text_decoded;
    $return[] = $code;
    return $return;
}

