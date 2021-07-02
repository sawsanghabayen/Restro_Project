<?php
// Loading up TestCase
use PHPUnit\Framework\TestCase;

require "./src/Password.php";

class PasswordTest extends TestCase{

    public function testOneDatatypePasswordGivesScoreOf1(){
        $pass = new Password("Foopassword");
        $strength = $pass->get_strength();

        // Asserting that strength is 1
        $this->assertEquals(1, $strength);

        $pass = new Password("123123123");
        $strength = $pass->get_strength();

        // Asserting that strength is 1
        $this->assertEquals(1, $strength);
    }
    public function testTwoDatatypePasswordGivesScoreOf2(){
        $pass = new Password("Foobar123");
        $strength = $pass->get_strength();

        // Asserting that strength is 1
        $this->assertEquals(2, $strength);
    }
    public function testScoreOf0ThrowsException()
    {
        // Declaring an Exception is expected in the below code
        $this->expectException(InvalidPasswordException::class);
        $pass = new Password("#!#!#!#!#!#!");
        $pass->validate();
    }
    public function testPasswordLengthLessThan8ThrowsException()
    {
        // Declaring an Exception is expected in the below code
        $this->expectException(InvalidPasswordException::class);
        $pass = new Password("bro");
        $pass->validate();
    }
}