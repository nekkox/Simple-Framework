<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\Attributes\Route;
use App\View;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

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

        $email = (new Email())
            ->from('support@example.com')
            ->to($email)
            ->subject('Welcome!')
            ->text($text);

        $dsn = 'smtp://mailhog:1025';
        $transporter = Transport::fromDsn($dsn);
        $mailer = new Mailer($transporter);
        $mailer->send($email);


    }

}