<?php

// Create array to hold list of todo items
$items = array();

function keyConvert($key) {
    $key--;
    return $key;
}
// The loop!
do {

    // Iterate through list items
    foreach ($items as $key => $item) {
        // Display each item and a newline
        $key++;
        echo "[{$key}] {$item}\n";
    }

    // Show the menu options
    echo '(N)ew item, (R)emove item, (Q)uit : ';

    // Get the input from user
    // Use trim() to remove whitespace and newlines
    $input = trim(strtolower((fgets(STDIN))));

    switch ($input) {

    // Check for actionable input
    case "n":
        // Ask for entry
        echo 'Enter item: ';
        // Add entry to list array
        $items[] = trim(fgets(STDIN));
        continue;
    case "r":
        // Remove which item?
        echo 'Enter item number to remove: ';
        // Get array key
        $key = trim(fgets(STDIN));
        //$key = $toRemove - 1;
        // Remove from array
        unset($items[keyConvert($key)]);
        continue;
    }
// Exit when input is (Q)uit
} while ($input != 'q');

// Say Goodbye!
echo "Goodbye!\n";

// Exit with 0 errors
exit(0);