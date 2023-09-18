<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Route;
use App\View;

class UserController
{
    #[Get('/router/users/create')]
    public function create (): View{
        return View::make("users/register_view");
    }

    #[Post('/router/users')]
    public function register(){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstname = explode(' ',$name)[0];

        $text = <<<BODY
Hello $firstname,
Thank you for registering!
BODY;

    }

}