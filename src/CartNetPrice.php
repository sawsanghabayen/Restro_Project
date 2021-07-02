<?php 
class CartNetPrice{
    public float $price;
    public  float $quantity;
    
    public function getNetPrice(): float{
        return $this->price * $this->quantity;
    }

public function addToPrice(int $amount){

    $this->price+=$amount;
}

}



?>