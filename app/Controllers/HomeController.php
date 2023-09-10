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

            $email = 'vegobeco@mail.com';
            $name = 'Beco';
            $age = 20;
            $query = 'INSERT INTO users (name, age, email) VALUES (:email, :age, :name)';
            $stmt = $db->prepare($query);
            $stmt->execute(['email' => $email, 'name' => $name, 'age' => $age]);

            $id = (int)$db->lastInsertId();

            $user = $db->query('SELECT * FROM users WHERE id = ' . $id)->fetch();
            var_dump($user);

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
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