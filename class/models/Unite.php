<?php
class Unite extends Model implements JsonSerializable {

    private $name;
    private $mouvement;
    private $damage;
    private $moral;

    function getName(){
        return $this->name;
    }

    function getMouvement(){
        return $this->mouvement;
    }

    function setName( $name ){
        $this->name = $name;
    }

    function setMouvement($mouvement){
        $this->mouvement = $mouvement;
    }

    function getDamage(){
        return $this->damage;
    }

    function setDamage($damage){
        $this->damage = $damage;
    }

    function setMoral($moral){
        $this->moral = $moral;
    }
    function getMoral(){
        return $this->moral;
    }

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "mouvement" => $this->mouvement,
            "damage" => $this->damage,
            "moral" => $this->moral,
        ];
    }
}