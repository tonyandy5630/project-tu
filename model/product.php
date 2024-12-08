<?php
require_once('../database/dbhelper.php');
loadModel('database');
loadModel('category');
class Product
{
    private string $id;
    private ?string $name;
    private ?string $img;
    private ?string $description;
    private ?string $price;
    private array $categories;
    private Database|null $db = null;
    function __construct()
    {
        $this->db = new Database();
    }
    static function construct_with_args(string $name, string $img, string $description, string $price, array $categories)
    {
        $class = new Product();
        $class->set_name($name);
        $class->set_img($img);
        $class->set_description($description);
        $class->set_price($price);
        $class->set_categories($categories);
        return $class;
    }


    static function construct_0_args()
    {
        return new Product();
    }

    function get_categories()
    {
        return $this->categories ?? [];
    }

    function set_categories(array $categories)
    {
        $this->categories = $categories;
    }

    function get_id()
    {
        return $this->id ?? "";
    }
    function get_name()
    {
        return $this->name ?? "";
    }

    function set_name($name)
    {
        $this->name = $name;
    }

    function get_img()
    {
        return $this->img ?? "";
    }

    function set_img($img)
    {
        $this->img = $img;
    }

    function get_description()
    {
        return $this->description ?? "";
    }

    function set_description($description)
    {
        $this->description = $description;
    }

    function get_price()
    {
        return $this->price ?? "";
    }

    function set_price($price)
    {
        $this->price = $price;
    }

    public function count()
    {
        try {
            if ($this->db === null) {
                throw new Exception('Connect to Database failed');
            }
            $sql = "SELECT COUNT(id) AS NumberOfProducts FROM coolmate.products;";
            $products = $this->db->execute_single_row($sql);
            return $products["NumberOfProducts"];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return 0;
    }
    public function get_all_product(int $page)
    {
        try {
            if ($this->db === null) {
                throw new Exception('Connect to Database failed');
            }
            $pageToQuery = ($page - 1) * PAGE_LIMIT;
            $LIMIT = PAGE_LIMIT;
            $sql = "select * from products ORDER BY UNIX_TIMESTAMP(iat) DESC LIMIT {$LIMIT} OFFSET {$pageToQuery}";
            $products = $this->db->execute_result($sql);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $products;
    }

    function create_product(array $category)
    {
        $con = $this->db->get_connection();
        $success = false;
        try {

            if ($con === null) {
                throw new Exception("Connect to Database failed");
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current = date('Y-m-d H:m:s');
            $con->autocommit(false);
            $con->begin_transaction();

            $uuid = $con->query("SELECT UUID()");
            $getUUID = mysqli_fetch_assoc($uuid);
            $newProductId = $getUUID["UUID()"];

            $addProduct = $con->query(query: "insert into products (id,name,price,image,description,iat) values('{$newProductId}','{$this->get_name()}','{$this->get_price()}','{$this->get_img()}','{$this->get_description()}','{$current}') ");
            if (!$addProduct) {
                return $success;
            }
            $con->commit();
            foreach ($category as $item) {
                $categoryInsert = $con->query("INSERT INTO product_category (categoryId, productId) 
                VALUES ('{$item}', '{$newProductId}')");
                if (!$categoryInsert) {
                    throw new Exception("Failed to insert into product_category: " . $con->error);
                }
            }
            $con->commit();

            $success = true;
            $con->close();
        } catch (Exception $e) {
            $con->rollback();
            echo $e->getMessage();
            return $success;
        }
        return $success;
    }


    function get_products_by_category(string $category)
    {
        try {
            if ($this->db === null) {
                throw new Exception('Connect to Database failed');
            }
            $sql = "SELECT p.id as 'id',
            p.name as 'name', 
            p.price as 'price',
            p.description as 'description', 
            p.iat as 'iat' ,
            p.image as 'image'
            FROM coolmate.products as p
            inner join coolmate.product_category as pd
            on p.id = pd.productId
            inner join category as cate
            on pd.categoryId = cate.id
            where cate.id =" . $category;
            $products = $this->db->execute_result($sql);
            return $products;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function get_product_by_id(string $id)
    {
        try {
            if ($this->db === null) {
                throw new Exception('Connect to Database failed');
            }
            if (trim($id) === "") {
                throw new Exception("Empty product Id");
            }

            $sql = "SELECT * FROM coolmate.products as p
                    where p.id='{$id}'";

            $queryProduct = $this->db->execute_single_row($sql);
            $conn = $this->db->get_connection();
            $categoriesSQL = "SELECT cate.id from coolmate.category as cate
                                inner join coolmate.product_category as pd
                                on cate.id = pd.categoryId
                                inner join coolmate.products as p
                                on p.id = pd.productId
                                where p.id = '{$id}'";
            $resultCategories = $conn->query($categoriesSQL);
            $categoriesData = [];
            while ($row = mysqli_fetch_assoc($resultCategories)) {
                $categoriesData[] = $row['id'];
            }

            $product = Product::construct_with_args($queryProduct["name"], $queryProduct["image"], $queryProduct["description"], $queryProduct["price"], $categoriesData);
            mysqli_free_result($resultCategories);
            return $product;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function update_product_by_id(string $id, Product $product)
    {
        $conn = $this->db->get_connection();
        try {
            if (trim($id) === "") {
                throw new Exception("Empty product Id");
            }

            $conn->autocommit(false);
            $conn->begin_transaction();
            $updateProductSQL = "UPDATE coolmate.products
                        SET name = '{$product->get_name()}',
                        price = '{$product->get_price()}', 
                        image = '{$product->get_img()}', 
                        description = '{$product->get_description()}'
                        WHERE id = '{$id}'";
            $conn->query($updateProductSQL);

            if (!$updateProductSQL) {
                throw new Exception("Update failed");
            }

            foreach ($product->get_categories() as $category) {
                $updateProductCategorySQL = "UPDATE coolmate.product_category as pd
                SET categoryId='{$category}' where pd.productId='{$id}'";

                $conn->query($updateProductCategorySQL);

                if (!$updateProductCategorySQL) {
                    throw new Exception("Failed to update into product_category: " . $conn->error);
                }
            }
            $conn->commit();
            $conn->close();
            return $product ?? null;
        } catch (Exception $e) {
            $conn->rollback();
            echo $e->getMessage();
        }
        return null;
    }

    function delete_product_by_id(string $id)
    {
        $conn = $this->db->get_connection();
        try {
            if (trim($id) === "") {
                throw new Exception("Empty product Id");
            }
            $conn->autocommit(false);
            $conn->begin_transaction();

            $deleteCategory = "DELETE FROM coolmate.product_category WHERE productId = '{$id}'";
            $deleteCategorySuccess = $conn->query($deleteCategory);

            if (!$deleteCategorySuccess) {
                throw new Exception("Cannot delete product category");
            }

            $sql  = "DELETE FROM coolmate.products WHERE id = '{$id}'";
            $result = $conn->query($sql);
            if (!$result) {
                throw new Exception("Something went wrong. Delete Product");
            }
            $conn->commit();
            $conn->close();
            return $result;
        } catch (Exception $e) {
            $conn->rollback();
            echo $e->getMessage();
        }
    }
}
