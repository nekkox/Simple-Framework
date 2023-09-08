<?php

namespace app\Controllers;

class HomeController
{
    public function index(){
        echo "HOME";
        echo "<br>";
        return <<<FORM
<form action="/router/upload" method="post" enctype="multipart/form-data">
    <input type="file" name="receipt" />
    <button type="submit">Upload</button>
</form>
FORM;

    }

    public function upload(){
    $filepath = STORAGE_PATH . '/'. $_FILES['receipt']['name'];
    move_uploaded_file($_FILES['receipt']['tmp_name'], $filepath);

    echo '<pre>';
    var_dump(pathinfo($filepath));
    echo '</pre>';

    }

}