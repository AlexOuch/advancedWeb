<?php
class Products extends Database{
    public $products = array();
    public function __construct(){
        parent::__construct();
    }public function getProducts(){
        $query = "
                select products.id, products.name, products.description, products.price, images.image_file_name
                from products
                inner join products_images
                on products.id = products_images.product_id
                inner join images
                on products_images.image_id = images.image_id
                ";
        $statement = $this -> connection -> prepare($query);
        $statement -> execute();
        $result = $statement -> get_result();
        while ( $row = $result -> fetch_assoc() ){
            array_push( $this -> products, $row );
        }
        return $this -> products;
    }
}
?>