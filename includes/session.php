<?php

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $logged_in = $_SESSION['logged_in'] ?? false;



function login($user)
{
    session_regenerate_id(true);

    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['custID']   = $user['custID'];
}




function require_login($logged_in)
{
    if ($logged_in == false) {
        header('Location: login.php');
        exit;
    }
}



function logout()
{
    $_SESSION = [];
    $params = session_get_cookie_params();

    setcookie(
        'PHPSESSID',
        '',
        time() - 3600,
        $params['path'],
        $params['domain'],
        $params['secure'],
        $params['httponly']
    );

    session_destroy();
}



function authenticate(PDO $pdo, string $username, string $password)
{
    $sql = "SELECT * 
            FROM customer 
            WHERE username = :username 
            AND password = :password;";
      return pdo($pdo, $sql, ['username' => $username, 'password' => $password])->fetch();
}