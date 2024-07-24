<?php

function homeIndex()
{
    $view = 'home';
    $postTop6Latest = postTop6LatestHome();
    require_once PATH_VIEW . 'layouts/master.php';
}
