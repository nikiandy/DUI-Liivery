<?php

class Product {
    public $name;
    public $description;
    public $category;
    public $price;
    public $id;

    public function __construct($name, $description, $category, $price, $product_id = null) {
        //can exist without an order
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
        $this->id = $product_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }
    
    public function displayProductDetails() {
    }
}
