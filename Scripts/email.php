<?php

//The script will the un in cmd
//We need to boot up the App to get access to the config and  other objects
//Because of it we dont need anything related to routing

use App\App;
use App\Container;
use App\Services\EmailService;

require_once __DIR__ . '/../vendor/autoload.php';

$container = new Container();

(new App($container))->boot();

$container->get(EmailService::class)->sendQueuedEmails();
echo 'All sent! to database';