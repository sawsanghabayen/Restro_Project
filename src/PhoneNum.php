<?php
class PhoneNum {
    protected $phone = "";
    function __construct($phone = "")
    {
        $this->phone = $phone;
    }
    public function validate(){
        if(strlen($this->phone) >15){
            throw new InvalidPhoneNumException();
        }
        if($this->get_strength()< 9 ){
            throw new InvalidPhoneNumException();
        }
    }
    public function get_strength(){
        
        if (preg_match('/^[+][0-9]/', $phone)) {//is the first character + followed by a digit
            
            $strength =1;
            $phone = str_replace(['+'], '', $phone, $strength); //remove +
            $phone = str_replace([' ', '.', '-', '(', ')'], '', $phone); 

            

        }
        
        return $strength;
    }
}
class InvalidPhoneNumException extends Exception{
    public function errorMessage()
    {
       //error message
       $errorMsg = 'Invalid phone Num.';
       return $errorMsg;
    }
}