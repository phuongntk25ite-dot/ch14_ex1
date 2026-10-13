<?php
class ProductDB {
    // 11. Sử dụng phương thức thông thường thay vì static[cite: 1]
    public function getProductsByCategory($category_id) {
        $db = Database::getDB();
        
        $categoryDB = new CategoryDB();
        $category = $categoryDB->getCategory($category_id);

        $query = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        
        $products = array();
        foreach ($statement as $row) {
            // 7. Khởi tạo đối tượng Product và dùng các hàm set[cite: 1]
            $product = new Product();
            $product->setCategory($category);
            $product->setId($row['productID']);
            $product->setCode($row['productCode']);
            $product->setName($row['productName']);
            $product->setPrice($row['listPrice']);
            $products[] = $product;
        }
        $statement->closeCursor();
        return $products;
    }

    public function getProduct($product_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM products WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $categoryDB = new CategoryDB();
        $category = $categoryDB->getCategory($row['categoryID']);

        $product = new Product();
        $product->setCategory($category);
        $product->setId($row['productID']);
        $product->setCode($row['productCode']);
        $product->setName($row['productName']);
        $product->setPrice($row['listPrice']);
        return $product;
    }

    public function deleteProduct($product_id) {
        $db = Database::getDB();
        $query = 'DELETE FROM products WHERE productID = :product_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    }

    public function addProduct($product) {
        $db = Database::getDB();
        $query = 'INSERT INTO products (categoryID, productCode, productName, listPrice)
                  VALUES (:category_id, :code, :name, :price)';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $product->getCategory()->getId());
        $statement->bindValue(':code', $product->getCode());
        $statement->bindValue(':name', $product->getName());
        $statement->bindValue(':price', $product->getPrice());
        $statement->execute();
        $statement->closeCursor();
    }
}
?>