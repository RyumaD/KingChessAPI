<?php 
class BddManager {

    private $userRepository;
    private $uniteRepository;
    private $connection;

    function __construct(){
        $this->connection = Connection::getConnection();
        $this->userRepository = new UserRepository( $this->connection );
        $this->uniteRepository = new UniteRepository( $this->connection );
    }

    function getUserRepository(){
        return $this->userRepository;
    }
    function getUniteRepository(){
        return $this->uniteRepository;
    }

}