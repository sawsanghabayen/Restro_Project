<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
require_once "..\src\Users.php";

class UsersTest extends TestCase
{



    public function test_add_user () {
        $table = 'users';
        $data = array(
            'username' => 'Sawsan',
            'email' => 'sawsan@gmail.com',
            'password' => 'sawsan123',
            );

        $answer = AddUsers::AddUser($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_edit_user () {

        $table = "users";
        $data = array(
            'name' => 'Soso',
            'email' => 'sawsan@gmail.com',
            'password' => 'Sawsan059'
            );

        $answer = Users::EditUserByEmail($table, $data);
        $this->assertEquals($answer, "ok");
    }

    public function test_delete_user_by_admin () {
        $table ="users";
        $data = 1;
        $answer = Users::DeleteUser($table, $data);
        $this->assertEquals($answer, "ok");
    }



}