<?php

namespace App\Controllers;

use App\App;
use App\Attributes\Get;
use App\Attributes\Route;
use App\Container;
use App\Enums\HttpMethod;
use App\Exceptions\NotFoundException;
use App\Exceptions\UploadingFileException;
use App\Models\Invoice;
use App\Models\SignUp;
use App\Models\User;
use App\Services\InvoiceService;
use App\Services\SalesTaxService;
use App\View;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }
    public function index(): View|string
    {
        //2 different ways to render a view:

        //returns string
        //return (new View('index_view'))->render();

        //returns object View

        //PDO
        $db = App::db();
        $email = 'vegobeco52@mail.com';
        $name = 'Becox';
        $age = 20;
        $amount = 200;


        //App::$container->get(InvoiceService::class)->process(['xxxx'], 44);

        //new version of the Service Container with Autowiring
       // (new Container())->get(InvoiceService::class) ?-> process([], 44);
        $this->invoiceService->process([], 25);


        echo '<br>';
        echo '<hr>';

            $userModel = new User();
            $invoiceModel = new Invoice();
            $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
                [
                    'email' => $email,
                    'name' => $name,
                    'age' => $age,
                ],
                [
                    'amount' => $amount,
                ]
            );

            return View::make('index_view', ['invoice' => $invoiceModel->find($invoiceId)]);
        }

    public function upload()
    {
        if (empty($_FILES)) {
            throw new UploadingFileException();
        }

        $filepath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];
        move_uploaded_file($_FILES['receipt']['tmp_name'], $filepath);

        header('Location: /router/');
        exit;
        /* echo '<pre>';
         var_dump(pathinfo($filepath));
         echo '</pre>';*/
    }

    public function download()
    {
        header('Content-Type: image/jpg');
        header('Content-Disposition: attachment; filename="xxxx.jpg"');
        readfile(STORAGE_PATH . '/' . 'modern-x86-assembly-language-programming-3rd.jpg');
    }

    public function attributes(){
        $reflection = new \ReflectionClass(PostController::class);
        $method = $reflection->getMethod('index');
        $attribute = $method->getAttributes();
        foreach ($attribute as $a){
            var_dump($a->getName());
        }
    }

    #[Get('/router/hellox')]
    public function show() {
        echo "Hello World";
    }
    #[Post('/router/hello')]
    public function store() {
        echo "Hello World";
    }

    #[Put('/router/hello')]
    public function up() {
        echo "Hello World";
    }

}