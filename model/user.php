<?php
loadModel('database');

abstract class User
{
    protected string $email;
    protected string $password;

    protected string $id;

    protected Database|null $db = null;

    function __construct()
    {
        if ($this->db === null) {
            $this->db = new Database();
        }
    }

    function get_email()
    {
        return $this->email ?? "";
    }

    function get_id()
    {
        return $this->id ?? "";
    }

    function set_email($email)
    {
        $this->email = $email;
    }

    function get_password()
    {
        return $this->password ?? "";
    }

    function set_password($password)
    {
        $this->password = $password;
    }

    abstract function login($email, $password);
    abstract function get_all($page);

    abstract function get_by_id($id);

    abstract function delete_by_id($id);

    abstract function add($user);
    abstract function edit($id, $user);

    abstract function count();
}
