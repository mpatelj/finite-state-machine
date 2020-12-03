<?php

/**
 * Finite State Machine Library in PHP for Modulo Three
 * 
 * @author Margesh Patel
 * @date 6:17 PM Wednesday, December 12, 2020
 **/

namespace App;

class StateMachine
{	
	public  $states = array();
	public  $curr_state;
	public  $input;
	public  $output;
	public  $bin_str = 0;
	public  $stop_flag = 2;
	
	/** 
	 *  Constructor
	 *  
	 *  Set up the Finite State Machine. Two arrays; one for the states 
	 *  containing the state number in the array key, and state output in 
	 *  the value. The transitions array is multi-dimensional and holds the 
	 *  expected/given input/output transitions. Psudeocode given as an example.
	 *  
	 *	You can build your own FSM by modifying it.
	 **/
	function __construct() {
	
		// Set the beginning state to 0
		$this->set_state(0);
		
		// Final state with their output      
		$this->states = array(  
			'0' => 0,
			'1' => 1,
			'2' => 2
		);	
							
		/** 
		 * The configuration is as follows, psuedocode
		 * 
		 * 's0' => ['if input is 0'] => ['go to s0'], ['if input is 1] => ['go to s1']
		 * 's1' => ['if input is 0'] => ['go to s2'], ['if input is 1] => ['go to s1'] 
		 * 's2' => ['if input is 0'] => ['go to s1'], ['if input is 1] => ['go to s2'] 
		 **/
								//s#    Input: //0\\      //1\\								
		$this->transitions = array( 
			'0' => ['0' => ['0'], '1' => ['1']], 
			'1' => ['0' => ['2'], '1' => ['0']],
			'2' => ['0' => ['1'], '1' => ['2']] // final state with 2 flag.
		);
							  
	}

	/**
	 * Print Transitions
	 * 
	 * Prints a human-readable view of the states and the transitions.
	 **/
	public function print_transitions() {
	
		foreach ($this->states as $state_num => $state_value) {
		
		$next_state[0] = $this->transitions[$state_num][0][0];
		$next_state[1] = $this->transitions[$state_num][1][0];
		
		print "\n";
		print "state({$state_num}) has an output of {$state_value}\n";
		print "--- state({$state_num}) -> if input(0)   -> new state: state({$next_state[0]})\n";
		print "--- state({$state_num}) -> if input(1)   -> new state: state({$next_state[1]})\n";
		
		}
		
	}
	
	/**
	 * Gets State
	 * 
	 * Gets the current state
	 **/
    public function get_state()
    {
        return $this->curr_state;
    }

	
	/**
	 * Gets State
	 * 
	 * Sets the current state
	 **/
	public function set_state($state)
    {
        $this->curr_state = $state;
    }
	
	/**
	 * Transition
	 * 
	 * Accepts input 0 or 1 and transitions to the next state based on
	 * the transitions array. Updates the curr_state variable.
	 **/
	public function transition($input)
    {
		$state_num = $this->curr_state;
		//echo "set state = $state_num\n";

		// If input = 0
		if($input == 0) {	
			$this->set_state( $this->transitions[$state_num][0][0] );
		} else {
			$this->set_state( $this->transitions[$state_num][1][0] );
		}
    }
		
	/**
	 * Process Binary String
	 * 
	 * Accepts a binary string like 1101 and then returns the output.
	 *
	 * If a stop flag is set, it checks for the specific output 
	 * identifier. This prevents unnecessary transitioning
	 * and state checking.
	 **/
	//public function process_bin_string($binaryString = 0) {
	public function process_bin_string() {
		// if (!empty($binaryString)) {
		// 	$this->curr_state = 0;
		// 	$this->bin_str = $binaryString;
		// }
		
		// Clear output buffer
		$this->output = '';
		
		//$this->bin_str = "01101011";
		//$this->bin_str = "00010010001000100010";
	
		/**
		 * Break the entire string into an array
		 * so we can cycle through it
		 **/
		
		$inputs = str_split($this->bin_str); 
		// print_r($inputs);
			
		foreach($inputs as $input) {
			// Transition and set the state
			$this->transition($input);				
		}
		
		$this->output = "{$this->states[$this->curr_state]}";

		return $this->output;
	}
	
	/**
	 * Process Binary String
	 * 
	 *  Accepts input and makes sure that the string submitted is binary
	 *  i.e. no letter characters. 11a01b does not work, it automatically
	 *	filters it to 11a01b by use of regex to filter out all non-numeric
	 *	characters that aren't 0 or 1
	 **/	
	public function filter_bin_string() {

		$this->bin_str = str_replace(" ", "", $this->bin_str); // remove spaces;
		$this->bin_str = preg_replace("/[^0-1]/", "", $this->bin_str);
				
		return $this->bin_str;
	}		
}
	
?>