<?php
loadModel('user');

class Admin extends User
{
    function __construct()
    {
        parent::__construct();
    }

    static function construct_with_args($email, $password)
    {
        $class = new Admin();
        $class->set_email($email);
        $class->set_password($password);
        return $class;
    }

    public function count()
    {
        try {
            if ($this->db === null) {
                throw new Exception('Connect to Database failed');
            }
            $sql = "SELECT COUNT(id) AS NumberOfProducts FROM coolmate.admins;";
            $products = $this->db->execute_single_row($sql);
            return $products["NumberOfProducts"];
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return 0;
    }

    function login($email, $password)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }

            $sql = "select * from admins where email = '$email' and password = '$password'";
            $admin = $this->db->execute_single_row($sql);
            if ($admin === null) {
                return null;
            }
            $loginAdmin = Admin::construct_with_args($admin["email"], $admin["password"]);
            return $loginAdmin;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    //LIMIT {$LIMIT} OFFSET {$pageToQuery}
    function get_all($page)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }
            $pageToQuery = ($page - 1) * PAGE_LIMIT + 1;
            $LIMIT = PAGE_LIMIT;
            $sql = "select * from admins ORDER BY UNIX_TIMESTAMP(iat) DESC ";
            $admins = $this->db->execute_result($sql);
            return $admins;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function get_by_id($id)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }

            $sql = "SELECT * from admins where id = '{$id}'";
            $resultAdmin = $this->db->execute_single_row($sql);

            $admin = Admin::construct_with_args($resultAdmin['email'], $resultAdmin['password']);
            return $admin;
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return null;
    }

    function delete_by_id($id)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }

            $sql = "DELETE FROM coolmate.admins WHERE id = '{$id}'";
            $result = $this->db->execute($sql);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function add($user)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $current = date('Y-m-d H:m');
            $sql = "INSERT INTO coolmate.admins (id,email,password,iat) VALUES
             (UUID(),
             '{$user->get_email()}',
            '{$user->get_password()}',
            '{$current}')";

            $result = $this->db->execute($sql);
            return $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function edit($id, $user)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }

            $existedUser = $this->get_by_id($id);
            if ($existedUser === null) {
                throw new Exception("User not existed");
            }

            $sql = "UPDATE coolmate.admins SET email = '{$user->get_email()}', password = '{$user->get_password()}' WHERE id = '{$id}'";
            $result = $this->db->execute($sql);

            return $result ? $user : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
