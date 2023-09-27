<?php
/*
declare(strict_types = 1);

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\View;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserController
{
    public function __construct(protected MailerInterface $mailer)
    {
    }

    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/register_view');
    }

    #[Post('/users')]
    public function register()
    {
        $name      = $_POST['name'];
        $email     = $_POST['email'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
Hello $firstName,

Thank you for signing up!
Body;

        $html = <<<HTMLBody
<h1 style="text-align: center; color: blue;">Welcome</h1>
Hello $firstName,
<br /><br />
Thank you for signing up!
HTMLBody;

        $email = (new Email())
            ->from('support@example.com')
            ->to($email)
            ->subject('Welcome!')
            ->attach('Hello World!', 'welcome.txt')
            ->text($text)
            ->html($html);

        $this->mailer->send($email);
    }
}*/


namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\View;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class UserController
{
    protected MailerInterface $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/register_view');
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Post('/users')]
    public function register()
    {
        echo "Hello World from userController";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
Hello $firstName, 
Thank you for signing up!

Body;


        $email = (new Email())
            ->from('supportx@examle.com')
            ->to($email)
            ->subject('Welcome')
            ->text($text);


        //$dsn = 'smtp://mailhog:1025';

        //$transport = Transport::fromDsn($_ENV['MAILER_DNS']);
        //$mailer = new Mailer($transport);
        $this->mailer->send($email);
    }
}