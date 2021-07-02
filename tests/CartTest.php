<?php 
// declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CartTest extends TestCase
{
    public function testCorrectNetPriceIsReturned(): void
    {
        require './src/CartNetPrice.php';
        $cart=new CartNetPrice();
        $cart->price=10;
        $cart->quantity=2;
        $netPrice=$cart->getNetPrice();
        $this->assertEquals(20,$netPrice);

    }

    public function testTryingToAddNotintToPrice()
    {
        try{
            $this->cart->addToPrice('fifteen');
            $this->fail('A Type Error Should Be Thrown');

        }catch(TypeError $error){
            $this->assertStringStartsWith('App\CartNetPrice.php::addToPrice():', $error->getMessage());
        }




}
}

?>