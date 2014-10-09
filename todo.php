<?php

// Create array to hold list of todo items
$items = array();

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

/*function sort_items($items) {
    echo '(A)-Z   (Z)-A  (O)rder Entered  (R)everse';
        $sort_type = getInput(true);
        switch ($sort_type) {
            case 'a':
                //echo sort_menu('a', $items);
                $items = asort($items);
                break;
            case 'z':
                $items = arsort($items);
                break;

            case 'o':
                $items = ksort($items);
                break;

            case 'r':
                $items = krsort($items);
                break;
        }
    return $items;
 }       
*/
// The loop!
do {

    // Iterate through list items
    //echo listItems($items);
    // Show the menu options
    echo '(N)ew item  (R)emove item  (S)ort  (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = getInput(true);

    switch ($input) {

    // Check for actionable input
    case "n":
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = getInput();
        continue;
    case "r":
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = getInput();
        //$key = $toRemove - 1;
        // Remove from array
        unset($items[keyConvert($key)]);
        continue;
    case "s":
   
        echo '(A)-Z   (Z)-A  (O)rder Entered  (R)everse';
        $sort_type = getInput(true);
        switch ($sort_type) {
            case 'a':
                asort($items);
                break;
            case 'z':
                arsort($items);
                break;

            case 'o':
                ksort($items);
                break;

            case 'r':
                krsort($items);
                break;
        }
    }

    echo listItems($items);
// Exit when input is (Q)uit
} while ($input != 'q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);