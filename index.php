<?php
namespace App;

use Api\TestApi;
use Exception;
use Throwable;

try {
    $route = trim($_REQUEST['route']??'index');

    if (substr($route,'-1') == '/') {
        $route.='index';
    }
    $visibility = 'hidden';

    if ($route == 'user') {
        try {
            $client = new TestApi();
            $visibility = 'visible';
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                if (($user = $client->getUser($_GET['username']))) {
                    $description = 'Пользователь получен';
                }
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user->fillModel($_POST);
                if ($client->updateUser($model)) {
                    $description = 'Пользователь обновлен';
                } else {
                    $description = 'Не удалось обновить пользователя';
                }
            }
        } catch (Exception $e) {
            $description = 'Не удалось соединиться с сервером';
        }
    }

    $filePath = dirname(__FILE__).'/view/'.$route.'.php';

    if (!file_exists($filePath)) throw new Exception('Route not found');

    include $filePath;
} catch (Throwable $ex) {
    include dirname(__FILE__).'/view/404.php';
}