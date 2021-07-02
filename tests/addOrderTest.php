<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once "..\src\Food.php";

class FoodTest extends TestCase
{

    public function test_add_order () {
        $table = 'food_details';
        $data = array(
            
            'food_name'=>'chiken',
            'food_description'=> 'mmmm',
            'food_salary' =>50,
            'food_Calories'=>90
            'food_photo' => 'chiken.jpg'
            );

        $answer = AddOrder::AddFoodModel($table,$data);
        $this->assertEquals($answer, "ok");
    }

    public function test_edit_order () {
        $table = 'food_details';
        'food_name'=>'burger',
        'food_description'=> 'mmmm',
        'food_salary' =>30,
        'food_Calories'=>80
        'food_photo' => 'burger.jpg'

        $answer = AddOrder::EditFoodModel($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_delete () {
        $table = 'food_details';
        $answer = AddOrder::DeleteOrderModel($table, 1);
        $this->assertEquals($answer, "ok");
    }

    

  
}