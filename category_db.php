<?php
class CategoryDB {
    // 9. Sử dụng phương thức thông thường (Regular Methods) thay vì static[cite: 1]
    public function getCategories() {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories ORDER BY categoryID';
        $statement = $db->prepare($query);
        $statement->execute();
        
        $categories = array();
        foreach ($statement as $row) {
            // 5. Khởi tạo đối tượng Category và dùng các hàm set[cite: 1]
            $category = new Category();
            $category->setId($row['categoryID']);
            $category->setName($row['categoryName']);
            $categories[] = $category;
        }
        $statement->closeCursor();
        return $categories;
    }

    public function getCategory($category_id) {
        $db = Database::getDB();
        $query = 'SELECT * FROM categories WHERE categoryID = :category_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        $category = new Category();
        $category->setId($row['categoryID']);
        $category->setName($row['categoryName']);
        return $category;
    }
}
?>