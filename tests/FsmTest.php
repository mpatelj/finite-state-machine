<?php

use \PHPUnit\Framework\TestCase;
use App\StateMachine;

class FSMTest extends TestCase
{
    private $fsm;

    public function setUp() : void {
        $this->fsm = new StateMachine;
    }

    public function testState() {
        $this->assertEquals(0, $this->fsm->process_bin_string('0000')); // 0000 = 0, should output 0
        $this->assertEquals(1, $this->fsm->process_bin_string('0001')); // 0001 = 1, should output 1
        $this->assertEquals(2, $this->fsm->process_bin_string('0010')); // 0010 = 2, should output 2
        $this->assertEquals(0, $this->fsm->process_bin_string('0011')); // 0011 = 3, should output 0
        $this->assertEquals(1, $this->fsm->process_bin_string('0100')); // 0100 = 4, should output 1
        $this->assertEquals(2, $this->fsm->process_bin_string('0101')); // 0101 = 5, should output 2
        $this->assertEquals(0, $this->fsm->process_bin_string('0110')); // 0110 = 6, should output 0
        $this->assertEquals(1, $this->fsm->process_bin_string('0111')); // 0111 = 7, should output 1
        $this->assertEquals(2, $this->fsm->process_bin_string('1000')); // 1000 = 8, should output 2
        $this->assertEquals(0, $this->fsm->process_bin_string('1001')); // 1001 = 9, should output 0
        $this->assertEquals(1, $this->fsm->process_bin_string('1010')); // 1010 = 10, should output 1
        $this->assertEquals(2, $this->fsm->process_bin_string('1011')); // 1011 = 11, should output 2
        $this->assertEquals(0, $this->fsm->process_bin_string('1100')); // 1100 = 12, should output 0
        $this->assertEquals(1, $this->fsm->process_bin_string('1101')); // 1101 = 13, should output 1
        $this->assertEquals(2, $this->fsm->process_bin_string('1110')); // 1110 = 14, should output 2
        $this->assertEquals(0, $this->fsm->process_bin_string('1111')); // 1111 = 15, should output 0
    }
}