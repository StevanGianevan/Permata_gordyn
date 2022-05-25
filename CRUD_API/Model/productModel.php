<?php
class ProductModel{
    private $id = "";
    private $name = "";
    private $price = "";
    private $size = "";
    private $colour = "";
    private $image1 = "";
    private $quantity = "";
    private $wp = "";
    private $lp = "";

    function __construct($id, $name, $price, $size, $colour, $image1, $quantity, $wp, $lp) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->size = $size;
        $this->colour = $colour;
        $this->image1 = $image1;
        $this->quantity = $quantity;
        $this->wp = $wp;
        $this->lp = $lp;
    }

    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }

    function getPrice(){
        return $this->price;
    }
    function getSize(){
        return $this->size;
    }
    function getColour(){
        return $this->colour;
    }
    function getImage1(){
        return $this->image1;
    }

    function getQuantity(){
        return $this->quantity;
    }
    function getWp(){
        return $this->wp;
    }
    function getLp(){
        return $this->lp;
    }

}

?>