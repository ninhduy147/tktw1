<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function checkUserToken($userId, $token)
{
    try {
        $sql = "SELECT token FROM users WHERE id = :id LIMIT 1";
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->bindParam(":id", $userId);
        $stmt->execute();
        $user = $stmt->fetch();

        return $user && $user['token'] === $token;
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
        return false;
    }
}

if (
    !isset($_SESSION['user']) || !isset($_SESSION['token']) ||
    !checkUserToken($_SESSION['user']['id'], $_SESSION['token'])
) {
    // Người dùng chưa đăng nhập hoặc token không khớp, chuyển hướng đến trang đăng nhập
    header('Location: ' . BASE_URL_ADM . '?act=login');
    exit();
}
