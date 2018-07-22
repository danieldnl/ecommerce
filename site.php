<?php

use \Hcode\Page;

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

$app->get('/categories/:idcategory', function($idcategory){
    $category = new Category();
    $category->get((int)$idcategory);
    $page = new Page();
	$page->setTpl("category", [
        'category' => $category->getValues(),
        'products' => []
    ]);
});