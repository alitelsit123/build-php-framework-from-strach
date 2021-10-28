<?php
require_once '../bootstrap/app.php';
$session = new Api\Http\Session();
$r = new Api\Http\Request();
$response = new Api\Http\Response(
    $r->capture()
);
$response->send();