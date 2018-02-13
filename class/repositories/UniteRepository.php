<?php 
class UniteRepository extends Repository {


    private function getUserByUsername( User $user ){

        $query = "SELECT * FROM user WHERE username=:username";
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "username" => $user->getUsername()
        ]);
        $result = $prep->fetch(PDO::FETCH_ASSOC);

        if( empty( $result ) ){
            return false;
        }
        else {
            return $result;
        }
        
    }

    function getInfo( Unite $unite ){
        $query = "SELECT * FROM unite WHERE name=:name";
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "name" => $unite->getName()
        ]);
        $result = $prep->fetch(PDO::FETCH_ASSOC);

        if( empty( $result ) ){
            return false;
        }
        else {
            return $result;
        }
        
    }

    function getAllUnite(){
        $query = "SELECT * FROM unite";
        $prep = $this->connection->prepare( $query );
        $prep->execute();
        $result = $prep->fetchAll(PDO::FETCH_ASSOC);

        if( empty( $result ) ){
            return false;
        }
        else {
            return $result;
        }
        
    }

    function getUserByToken( User $user ){
        $query = "SELECT * FROM user WHERE token=:token";
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "token" => $user->getToken()
        ]);
        $result = $prep->fetch(PDO::FETCH_ASSOC);

        if( empty( $result ) ){
            return false;
        }
        else {
            return $result;
        }
        
    }

    function check(User $user){
        return $this->getUserByUsername($user);
    }

    function register( User $user ){
        $flag = $this->getUserByUsername($user);
        
        if(empty($flag)){
            return $this->signin( $user );
        }
    }

    private function signin( User $user ){
        $query = "INSERT INTO user SET username=:username, password=:password";
        $prep = $this->connection->prepare( $query );
        $prep->execute( [
            "username" => $user->getUsername(),
            "password" => $user->getPassword(),
        ] );
        return $this->connection->lastInsertId();
    }
    
    function login( User $user ){
        $query = "SELECT * FROM user WHERE username=:username AND password=:password";
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "username" => $user->getUsername(),
            "password" => $user->getPassword()
        ]);
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        if( empty( $result ) ){
            return false;
        }
        else{
            return $result;
        }
    }
    function getUserIdByName($user){
        $query = "SELECT id FROM user WHERE username=:username";
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "username" => $user
        ]);
        $result = $prep->fetch(PDO::FETCH_ASSOC);
        if( empty( $result ) ){
            return false;
        }
        else{
            return $result["id"];
        }
    }
    function updateToken($user){
        $query = "UPDATE user SET token=:token WHERE username=:username";
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "username" => $user->getUsername(),
            "token" => $user->getToken(),
        ]);
        return $user->getToken();
    }
}