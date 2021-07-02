<?php
class Password {
    protected $password = "";
    
    function __construct($password = "")
    {
        $this->password = $password;
    }
    public function validate(){
        if(strlen($this->password) < 8){
            throw new InvalidPasswordException();
        }
        if($this->get_strength() == 0){
            throw new InvalidPasswordException();
        }
    }
    public function get_strength(){
        $strength = 0;
        if(preg_match('/[A-Za-z]/', $this->password)){
            // Letter found!
            $strength +=1;
        }
        if(preg_match('/[0-9]/', $this->password)){
            // Digit found!
            $strength += 1;
        }
        return $strength;
    }
}
class InvalidPasswordException extends Exception{
    public function errorMessage()
    {
       //error message
       $errorMsg = 'Invalid password. Make sure the password length is more than 8 and contains alphanumeric characters.';
       return $errorMsg;
    }
}