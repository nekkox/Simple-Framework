<?php

namespace app\Controllers;

use app\View;

class HomeController
{
    public function index(){
        return (new View('index_view'))->render();
    }

    public function upload(){
    $filepath = STORAGE_PATH . '/'. $_FILES['receipt']['name'];
    move_uploaded_file($_FILES['receipt']['tmp_name'], $filepath);

    echo '<pre>';
    var_dump(pathinfo($filepath));
    echo '</pre>';

    }

}