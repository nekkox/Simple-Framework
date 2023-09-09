<?php

namespace app\Controllers;

use app\View;

class HomeController
{
    public function index(): View|string
    {
        //2 different ways to render a view:

        //returns string
        //return (new View('index_view'))->render();

        //returns object View
       return (string) View::make('index_view',["foo" => "bar"]);
    }

    public function upload(){
    $filepath = STORAGE_PATH . '/'. $_FILES['receipt']['name'];
    move_uploaded_file($_FILES['receipt']['tmp_name'], $filepath);

    echo '<pre>';
    var_dump(pathinfo($filepath));
    echo '</pre>';

    }

}