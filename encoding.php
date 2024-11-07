<?php

echo "Hello World!";

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo '<br>';
echo generateRandomString(4);


function encoder ($str) {
    $str_array = str_split($str);

    // $output = "";

    $letters_arr = [];
    
    foreach ($str_array as $key => $value) {

        {
            if ($value == "a") {
                array_push($letters_arr, "cmDYp2");
            } else if ($value == "b") {
                array_push($letters_arr, "cmrOoI");
            } else if ($value == "c") {
                array_push($letters_arr, "cmyMIh");
            } else if ($value == "d") {
                array_push($letters_arr, "cmh8FV");
            } else if ($value == "e") {
                array_push($letters_arr, "cmiTsx");
            } else if ($value == "f") {
                array_push($letters_arr, "cm4dTA");
            } else if ($value == "g") {
                array_push($letters_arr, "cm5KtJ");
            } else if ($value == "h") {
                array_push($letters_arr, "cmcnMt");
            } else if ($value == "i") {
                array_push($letters_arr, "cm5iQU");
            } else if ($value == "j") {
                array_push($letters_arr, "cmo0kc");
            } else if ($value == "k") {
                array_push($letters_arr, "cmaOzw");
            } else if ($value == "l") {
                array_push($letters_arr, "cmwOMX");
            } else if ($value == "m") {
                array_push($letters_arr, "cmwOMX");
            } else if ($value == "n") {
                array_push($letters_arr, "cm");
            } else if ($value == "o") {
                array_push($letters_arr, "cm");
            } else if ($value == "p") {
                array_push($letters_arr, "cm");
            } else if ($value == "q") {
                array_push($letters_arr, "cm");
            } else if ($value == "r") {
                array_push($letters_arr, "cm");
            } else if ($value == "s") {
                array_push($letters_arr, "cm");
            } else if ($value == "t") {
                array_push($letters_arr, "cm");
            } else if ($value == "u") {
                array_push($letters_arr, "cm");
            } else if ($value == "v") {
                array_push($letters_arr, "cm");
            } else if ($value == "w") {
                array_push($letters_arr, "cm");
            } else if ($value == "x") {
                array_push($letters_arr, "cm");
            } else if ($value == "y") {
                array_push($letters_arr, "cm");
            } else if ($value == "z") {
                array_push($letters_arr, "cm");
            } 
            
            else if ($value == "A") {
                array_push($letters_arr, "bm");
            } else if ($value == "B") {
                array_push($letters_arr, "bm");
            } else if ($value == "C") {
                array_push($letters_arr, "bm");
            } else if ($value == "D") {
                array_push($letters_arr, "bm");
            } else if ($value == "E") {
                array_push($letters_arr, "bm");
            } else if ($value == "F") {
                array_push($letters_arr, "bm");
            } else if ($value == "G") {
                array_push($letters_arr, "bm");
            } else if ($value == "H") {
                array_push($letters_arr, "bm");
            } else if ($value == "I") {
                array_push($letters_arr, "bm");
            } else if ($value == "J") {
                array_push($letters_arr, "bm");
            } else if ($value == "K") {
                array_push($letters_arr, "bm");
            } else if ($value == "L") {
                array_push($letters_arr, "bm");
            } else if ($value == "M") {
                array_push($letters_arr, "bm");
            } else if ($value == "N") {
                array_push($letters_arr, "bm");
            } else if ($value == "O") {
                array_push($letters_arr, "bm");
            } else if ($value == "P") {
                array_push($letters_arr, "bm");
            } else if ($value == "Q") {
                array_push($letters_arr, "bm");
            } else if ($value == "R") {
                array_push($letters_arr, "bm");
            } else if ($value == "S") {
                array_push($letters_arr, "bm");
            } else if ($value == "T") {
                array_push($letters_arr, "bm");
            } else if ($value == "U") {
                array_push($letters_arr, "bm");
            } else if ($value == "V") {
                array_push($letters_arr, "bm");
            } else if ($value == "W") {
                array_push($letters_arr, "bm");
            } else if ($value == "X") {
                array_push($letters_arr, "bm");
            } else if ($value == "Y") {
                array_push($letters_arr, "bm");
            } else if ($value == "Z") {
                array_push($letters_arr, "bm");
            }
        }

        // if ($value == "a") {
        //     array_push($letters_arr, "Checnged");
        // } else if ($value == "b") {
        //     array_push($letters_arr, "hmm");
        //     // $output .= "mere bhai";
            
        // } else {
        //     array_push($letters_arr, $value);
        //     // $output .= $value;
        // }
        
    }
    $output = implode("", $letters_arr);
    return $output;
}

echo "<br>";
echo encoder('halbo');

?>