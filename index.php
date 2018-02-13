<?php

header("Access-Control-Allow-Origin:*",false);
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
require "flight/Flight.php"; 
require "autoload.php";

//Enregistrer en global dans Flight le BddManager
Flight::set("BddManager", new BddManager());


Flight::route("OPTIONS|POST /login", function(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, TRUE);
    $username = $data['username'];
    $password = $data['password'];
    $token = $data['token'];
    $status = [
        "success" => false,
        "id" => 0
    ];
    if( strlen( $username ) > 0 && strlen( $password ) > 0 ) {
        $user = new User();
        $user->setUsername( $username );
        $user->setPassword( $password );
        $user->setToken( $token );
        $bddManager = Flight::get("BddManager");
        $repo = $bddManager->getUserRepository();
        $id = $repo->login( $user );
        if($id != 0){
            $pacte = $repo->updateToken( $user );
        }
        if( $id != 0 ){
            $status["success"] = true;
            $status["id"] = $id;
            $status["token"] = $pacte;
        }
    }
    echo json_encode( $status ); 
});

Flight::route("OPTIONS|POST /signin", function(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, TRUE);
    $username = $data['username'];
    $password = $data['password'];
    $status = [
        "success" => false,
        "id" => 0
    ];
    if( strlen( $username ) > 0 && strlen( $password ) > 0 ) {
        $user = new User();
        $user->setUsername( $username );
        $user->setPassword( $password );
        $bddManager = Flight::get("BddManager");
        $repo = $bddManager->getUserRepository();
        $id = $repo->register( $user );
        if( $id != 0 ){
            $status["success"] = true;
            $status["id"] = $id;
        }
    }
    echo json_encode( $status ); 
});
Flight::route("OPTIONS|GET /userid", function(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, TRUE);
    $id = $data['id'];
    $status = [
        "success" => false,
        "id" => 0
    ];
    $user = new User();
    $user->setId($id);
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager->getUserRepository();
    $id = $repo->getUserById( $user );
    if( $id != 0 ){
        $status["success"] = true;
        $status["id"] = $id;
    }
    echo json_encode( $status ); 
});

Flight::route("OPTIONS|POST /token", function(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, TRUE);
    $token = $data['token'];
    $status = [
        "success" => false,
        "id" => 0
    ];
    $user = new User();
    $user->setToken($token);
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager->getUserRepository();
    $id = $repo->getUserByToken( $user );
    if( $id != 0 ){
        $status["success"] = true;
        $status["id"] = $id;
    }
    echo json_encode( $status ); 
});

Flight::route("OPTIONS|POST /admin", function(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, TRUE);
    $username = $data['username'];
    $status = [
        "success" => false,
        "id" => 0
    ];
    $user = new User();
    $user->setUsername($username);
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager->getUserRepository();
    $id = $repo->check( $user );
    if( $id != 0 ){
        $status["success"] = true;
        $status["id"] = $id;
    }
    echo json_encode( $status ); 
});

Flight::route("OPTIONS|POST /unite", function(){
    $json = file_get_contents('php://input');
    $data = json_decode($json, TRUE);
    $name = $data['name'];
    $status = [
        "success" => false,
        "id" => 0
    ];
    $unite = new Unite();
    $unite->setName($name);
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager->getUniteRepository();
    $id = $repo->getInfo( $unite );
    if( $id != 0 ){
        $status["success"] = true;
        $status["id"] = $id;
    }
    echo json_encode( $status ); 
});

Flight::route("OPTIONS|GET /allunite", function(){
    $status = [
        "success" => false,
        "id" => 0
    ];
    $bddManager = Flight::get("BddManager");
    $repo = $bddManager->getUniteRepository();
    $id = $repo->getAllUnite();
    if( $id != 0 ){
        $status["success"] = true;
        $status["id"] = $id;
    }
    echo json_encode( $status ); 
});

Flight::start();