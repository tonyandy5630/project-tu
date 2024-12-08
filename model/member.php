<?php
loadModel('user');
class Member extends User
{
    private $username;
    private $phone_number;

    function __construct()
    {
        parent::__construct();
    }

    static function construct_with_args($username, $phone_number, $email, $password)
    {
        $class = new Member();
        $class->set_email($email);
        $class->set_phone_number($phone_number);
        $class->set_username($username);
        $class->set_password($password);
        return $class;
    }

    public function get_username()
    {
        return $this->username ?? "";
    }

    public function set_username($username)
    {
        $this->username = $username;
    }

    public function set_phone_number($phone)
    {
        $this->phone_number = $phone;
    }

    public function get_phone_number()
    {
        return $this->phone_number ?? "";
    }

    public function count()
    {
        try {
            if ($this->db === null) {
                throw new Exception('Connect to Database failed');
            }
            $sql = "SELECT COUNT(id) AS NumberOfProducts FROM coolmate.members;";
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

            $sql = "select * from members where email = '$email' and password = '$password'";
            $member = $this->db->execute_single_row($sql);
            if ($member === null) {
                return null;
            }
            $member = Member::construct_with_args($member['username'], $member['phone_number'], $member['id'], $member['email'], $member['password']);
            return $member;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function get_all($page)
    {
        try {
            if ($this->db === null) {
                throw new Exception("Connect to Database failed");
            }
            $pageToQuery = ($page - 1) * PAGE_LIMIT;
            $LIMIT = PAGE_LIMIT;
            $sql = "select * from members ORDER BY UNIX_TIMESTAMP(iat) DESC LIMIT {$LIMIT} OFFSET {$pageToQuery}";
            $members = $this->db->execute_result($sql);
            return $members;
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

            $sql = "SELECT * from coolmate.members where id = '{$id}'";
            $resultMember = $this->db->execute_single_row($sql);

            $member = Member::construct_with_args($resultMember['username'], $resultMember['phone_number'], $resultMember['email'], $resultMember['password']);
            return $member;
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

            $sql = "DELETE FROM coolmate.members WHERE id = '{$id}'";
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
            $sql = "INSERT INTO coolmate.members (id,username,phone_number,email,password,iat) VALUES
             (UUID(),
             '{$user->get_username()}', 
             '{$user->get_phone_number()}', 
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

            $existUser = $this->get_by_id($id);
            if ($existUser === null) {
                throw new Exception("User not existed");
            }

            $sql = "UPDATE coolmate.members SET username = '{$user->get_username()}', phone_number = '{$user->get_phone_number()}', email = '{$user->get_email()}', password = '{$user->get_password()}' WHERE id = '{$id}'";
            $result = $this->db->execute($sql);
            return $result !== null ? $user : null;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
