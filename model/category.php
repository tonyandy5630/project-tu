<?php
loadModel('database');

class Category
{
    private Database|null $db = null;
    private $name;
    function __construct()
    {
        $this->db = new Database();
    }

    static function construct_0_args()
    {
        $class = new Category();
        return $class;
    }

    static function construct_with_args_category($name)
    {
        $class = new Category();
        $class->set_name($name);
        return $class;
    }

    function get_name()
    {
        return $this->name ?? "";
    }

    function set_name($name)
    {
        $this->name = $name;
    }

    function get_all_category()
    {
        try {
            $con = $this->db;
            if ($con === null) {
                throw new Exception('Connect to Database failed');
            }
            $sql = "select * from category";
            $categories = $con->execute_result($sql);
            return $categories;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
