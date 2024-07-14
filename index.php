<?php

//Require các file có trong dự án
require_once './common/env.php';
require_once './common/helper.php';
require_once './common/connect-db.php';
require_once './common/model.php';

require_file(PATH_CONTROLLER);
require_file(PATH_MODEL);

//Điều Hướng

$act = $_GET['act'] ?? '/';

$result = match ($act) {
    '/' => homeIndex(),
    'cart' => cartIndex(),
    // 'logout' => authenLogout(),
};


require_once './common/disconnect-db.php';
