<?php

namespace App\Controllers;

use App\Attributes\Route;
use App\View;

class PostController
{
#[Route('/router/posts')]
    public function index() {
        echo 'Hello from Posts'.'<br>';
        return View::make('post_view',['name' => 'vego']);
    }

}