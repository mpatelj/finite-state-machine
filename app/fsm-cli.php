<?php
		
/**
 * Finite State Machine designed for Modulo Three
 * 
 * @author Margesh Patel
 * @date 6:17 PM Wednesday, December 12, 2020
 **/

/**
 * Load Library
 **/

require('StateMachine.php');

use App\StateMachine;

$fsm = new StateMachine();


/**
 * Show options
 **/
 
print "~~~~~~~~~~~~~~~~~~~~~~~~~ \n";
print "Finite State Machine - Modulo Three\n";
print "~~~~~~~~~~~~~~~~~~~~~~~~~ \n\n";
echo  "Options:\n\n";
echo "1. Enter input strings\n";
echo "2. Print states and transitions\n";
echo "3. Quit\n";

echo "\n\n";
echo "Enter a number choice to select: ";

$cin = fopen ("php://stdin","r"); // cin >> equivalent
$line = fgets($cin);

/**
 * Enter input strings
 **/
 
if(trim($line) == 1){
	while(1) {
	
		echo "Enter an input string (or 'q' to quit): ";
		$cin = fopen ("php://stdin","r");
		
		$fsm->bin_str = fgets($cin);
		
		if(trim($fsm->bin_str) == 'q'){
			exit();
		}
		
		// Set the starting state to 0
		$fsm->set_state(0);
				
		// Filter the strings to remove bad characters
		$fsm->filter_bin_string();

		// Process bin string input/output selection
		$fsm->process_bin_string();
				
		if (preg_match_all('/[0-1]/m', $fsm->bin_str, $matches, PREG_SET_ORDER, 0)) { 
			echo "String is ACCEPTED.\n";
			echo "Output: {$fsm->output}";
		} else {
			echo "String is NOT ACCEPTED\n";
			echo "Output: {$fsm->output}";
		}		
		echo "\n";
	}
}

/**
 * Print states and transitions
 **/
  
if(trim($line) == 2){
	$fsm->print_transitions();
	
	sleep(10);
    exit;
}


/**
 * Quit
 **/
  
if(trim($line) == 3){
    exit;
}

?>