<?php $view = "user/login";
$title = "Login";
loadModel('member');

$loginFailed = false;
if (!empty($_POST)) {
    $email = $password = '';
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }
    if (!empty($email)) {
        $admin = new Member();
        $loginMember = $admin->login($email, $password);
        if ($loginMember !== null) {
            //login success
            $_SESSION['email'] = $loginMember->get_username();
            header('Location: /');
            die();
        }
        $loginFailed = true;
    }
}


loadView($view, $title, USER, [
    "loginFailed" => $loginFailed
]);
