<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';

use \Slim\Slim;
use \Hcode\Page;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {
	$page = new Page();
	$page->setTpl("index");
});

$app->get('/teste/:nome', function ($nome) {
    echo json_encode([
        'data' => date('Y-m-d H:i:s'),
        'nome' => $nome,
    ]);
});

$app->run();