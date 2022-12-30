<?php
    declare(strict_types = 1);

    // head config.
    header("Access-Control-Allow-Origin: * ");    
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, PATCH");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    define('PATH', getcwd());
    require PATH .'/env.php';
    require PATH .'/app.php';
    require PATH .'/Helper/helper.class.php';
    require PATH .'/Models/database.php';  
    require PATH .'/Routers/router.php';
    require PATH .'/Routers/product.php'; 

    $app = new App($_SERVER['REQUEST_URI'],$_SERVER["REQUEST_METHOD"],file_get_contents('php://input'));
    $app->setDataBase($db);
    $app->setRouters($productRouter);
    $app->run();
?>