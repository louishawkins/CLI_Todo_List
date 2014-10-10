<?php

// Create array to hold list of todo items
//$items = array('cat', 'dog', 'goat');
$items = [];
function listItems($items) {
    $_list = "";
    foreach ($items as $key => $item) {
        // Display each item and a newline
        $key++;
        $_list .= "{$key}. {$item}\n";
    }
    return $_list;
}

function getInput($lower = false) {
    
    switch($lower) {
        case true:
            $input = trim(strtolower(fgets(STDIN)));
            break;
        case false: 
            $input = trim(fgets(STDIN));
            break;
    }
    return $input;
}

function keyConvert($key) {
    $key--;
    return $key;
}

function newItem($items){
    // Ask for entry
    echo 'Enter item: ';
    // Add entry to list array
    if(empty($items) == true) {
        $items[] = getInput();
    }
    else {
        echo '(B)eginning or (E)nd? ';
        $choice = getInput(true);
        switch($choice){
            case 'b':
                array_unshift($items, getInput());
                break;
            case 'e':
                array_push($items, getInput());
                break;
            default:
                $items[] = getInput();
                break;
        }
    }
    return $items;
}


function removeItem() {
    // potential function
}

function sort_items($items_array) {
    echo '(A)-Z   (Z)-A  (O)rder Entered  (R)everse';
        $sort_type = getInput(true);
        switch ($sort_type) {
            case 'a':
                asort($items_array);
                break;
            case 'z':
                arsort($items_array);
                break;
            case 'o':
                ksort($items_array);
                break;
            case 'r':
                krsort($items_array);
                break;
        }
    return $items_array;
 }       

function get_the_file($file){
    //$filename = 'cities.txt';
    $handle = fopen($file, 'r');
    $contents = fread($handle, filesize($file));
    $contentsArray = explode("\n", $contents);
    fclose($handle);
    for($i = 0; $i < count($contentsArray); $i++) {
        $contentsArray[$i] = trim($contentsArray[$i]);
        if(empty($contentsArray[$i]) == true) {
            unset($contentsArray[$i]);
            array_values($contentsArray);
        }
        else {}
    }   
    return $contentsArray;
}

function save_the_file($filename, $array){

    $handle = fopen($filename, 'w+');
    foreach ($array as $item) {
        fwrite($handle, PHP_EOL . $item);
    }
    fclose($handle);
    return;
}
// The loop!
do {

    // Iterate through list items
    echo listItems($items);
    // Show the menu options
    echo '(F)ile  s(A)ve  (N)ew item  (R)emove item  (S)ort  (Q)uit : ';
    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = getInput(true);

    switch ($input) {
    // Check for actionable input
        case "f":
            echo "(I)mport File  (O)pen File\n";
            $input = getInput(true);
            switch($input) {
                case "i":
                    echo "> data/";
                    $_filename = 'data/' . getInput();
                    $filedata = get_the_file($_filename);
                    foreach($filedata as $thing) {
                        $items[] = $thing;
                    }
                    break;
                case "o":
                    unset($items);
                    echo "> data/";
                    $_filename = 'data/' . getInput();
                    $filedata = get_the_file($_filename);
                    foreach($filedata as $thing) {
                        $items[] = $thing;
                    }
                    break;
                
                default:
                    break;
            }
            break;
        case "a":
            echo "\nFile Name:\n\n";
            echo "> data/";
            $_filename = 'data/' . getInput();
            save_the_file($_filename, $items);
            break;
        case "n":
            $items = newItem($items);
            break;
        case "r":
            // removeItem();
            // Remove which item?
            echo 'Enter item number to remove: ';
            // Get array key
            $key = getInput();
            //$key = $toRemove - 1;
            // Remove from array
            unset($items[keyConvert($key)]);
            $items = array_values($items);
            break;
            case "s":
            $items = sort_items($items);
            break;
        case "x":
            array_shift($items);
            break;
        case "l":
            array_pop($items);
            break;
    }
// Exit when input is (Q)uit
} while ($input != 'q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);