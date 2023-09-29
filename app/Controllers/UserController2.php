<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\View;
use Symfony\Component\Mime\Address;


class UserController2
{


    #[Get('/users2/create')]
    public function create(): View
    {
        return View::make('users2/register_view');
    }

    #[Post('/users2')]
    public function register()
    {
        echo "Hello World from userController2";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
Hello $firstName, 
Thank you for signing up!

Body;


        $htmlBody = <<<HTMLBody
<h1 style="text-align: center; color: blue;">Welcome</h1>
Hello $firstName
<br /><br />
Thank you for signing up!
HTMLBody;

        //queue the email saving it to the database
        (new \App\Models\Email())->queue(new Address($email), new Address('support@example.com', 'Support'), 'Welcome', $htmlBody, $text);

    }
}