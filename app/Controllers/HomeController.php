<?php

namespace app\Controllers;

use app\Exceptions\UploadingFileException;
use app\View;

class HomeController
{
    public function index(): View|string
    {
        //2 different ways to render a view:

        //returns string
        //return (new View('index_view'))->render();

        //returns object View

        //PDO
        try {
            $db = new \PDO('mysql:host=127.0.0.1;dbname=my_db', 'root', '');
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $email = 'vegobeco12@mail.com';
        $name = 'Becox';
        $age = 20;
        $amount = 200;

        $db->beginTransaction();

        $query = 'INSERT INTO users (name, age, email) VALUES (:name, :age, :email )';
        $newUserStmt = $db->prepare($query);
        //$stmt->execute(['email' => $email, 'name' => $name, 'age' => $age]);
        $newInvoiceStmt = $db->prepare('INSERT INTO invoices (amount, user_id) VALUES (:amount, :user_id)');

        $newUserStmt->execute(['name' => $name, 'age' => $age, 'email' => $email]);

        $userId = (int)$db->lastInsertId();

        $newInvoiceStmt->execute(['amount' => $amount, 'user_id' => $userId]);

        $db->commit();

        $fetchStmt = $db->prepare(
            'SELECT invoices.id AS invoice_id, amount, user_id, name
                        FROM invoices
                        INNER JOIN users ON users.id = user_id
                        WHERE email = :email'
        );

        $fetchStmt->execute(['email' => $email]);
        var_dump($fetchStmt->fetch(\PDO::FETCH_ASSOC));

        return (string)View::make('index_view', ["foo" => "bar"]);

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

}