<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once 'vendor/autoload.php';

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function () {
	$page = new Page();
	$page->setTpl("index");
});

$app->get('/admin', function () {
    User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");
});

$app->get('/admin/login', function () {
	$page = new PageAdmin([
        "header" => false,
        "footer" => false
    ]);
	$page->setTpl("login");
});

$app->post('/admin/login', function(){
    User::login($_POST["login"], $_POST["password"]);
    header("Location: /admin");
    exit;
});

$app->get('/admin/logout', function(){
    User::logout();
    header("Location: /admin/login");
    exit;
});

$app->get('/teste/:nome', function ($nome) {
    echo json_encode([
        'data' => date('Y-m-d H:i:s'),
        'nome' => $nome,
    ]);
});

$app->run();