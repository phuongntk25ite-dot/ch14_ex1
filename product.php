<?php
class Product {
    private $category;
    private $id;
    private $code;
    private $name;
    private $price;

    public function __construct() {
        $this->category = null;
        $this->id = 0;
        $this->code = '';
        $this->name = '';
        $this->price = 0.0;
    }

    public function getCategory() { return $this->category; }
    public function setCategory($value) { $this->category = $value; }
    public function getId() { return $this->id; }
    public function setId($value) { $this->id = $value; }
    public function getCode() { return $this->code; }
    public function setCode($value) { $this->code = $value; }
    public function getName() { return $this->name; }
    public function setName($value) { $this->name = $value; }
    public function getPrice() { return $this->price; }
    public function setPrice($value) { $this->price = $value; }

    public function getFormattedPrice() {
        return number_format($this->price, 2);
    }

    public function getPriceFormatted() {
        return number_format($this->price, 2);
    }
}
?>