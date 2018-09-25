<?php
class ProductDetail extends Products{
    public function __construct(){
        parent::__construct();
    }
    public function getProduct( $id ){
        $query = "
                select products.id, products.name, products.description, products.price, images.image_file_name
                from products
                inner join products_images
                on products.id = products_images.product_id
                inner join images
                on products_images.image_id = images.image_id
                where products.id = ?
                ";
        $statement= $this -> connection -> prepare($query);
        $statement -> bind_param('i', $id);
        $statement -> execute();
        $result = $statement -> get_result();
        $product_detail = array();
        while($row = $result -> fetch_assoc()){
            array_push($product_detail, $row);
        }
        return $product_detail;
    }
}
?>