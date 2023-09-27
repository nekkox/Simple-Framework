<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class PonyController
{
    #[Get('/pony/create')]
    public function create(): View
    {
        return View::make('users/register_pony_view');
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Post('/pony')]
    public function register()
    {
        echo "Hello World from PonyController";

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
Hello $firstName, 
Thank you for signing up!

Body;

        $html = <<<HTMLBody
<h1>Hello $firstName,</h1> 
<p>Thank you for signing up!</p>

HTMLBody;



        $email = (new Email())
            ->from('supportx@examle.com')
            ->to($email)
            ->subject('Welcome')
            ->text($text)
            ->html($html);


        $dsn = 'smtp://mailhog:1025';
        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);
        $mailer->send($email);
    }
}