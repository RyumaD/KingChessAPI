<?php
class User extends Model implements JsonSerializable {

    private $username;
    private $password;
    private $token;

    function getUsername(){
        return $this->username;
    }

    function getPassword(){
        return $this->password;
    }

    function setUsername( $username ){
        $this->username = $username;
    }

    function setPassword($password){
        $this->password = $password;
    }

    function setUserId($userid){
        $this->userid = $userid;
    }

    function setToken($token){
        $this->token = $token;
    }
    function getToken(){
        return $this->token;
    }

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "username" => $this->username,
            "password" => $this->password,
            "token" => $this->token,
        ];
    }

}