<?php
require_once('../../utils/utility.php');
require_once('../../database/dbhelper.php');

$action = getPost('action');

if ($action == 'delete') {
    $id = getPost('id');
    $user = executeResult("SELECT * FROM user WHERE id = $id", true);
    if ($user && $user['role_id'] != 1) {
        execute("UPDATE user SET deleted = 1 WHERE id = $id");
    }
}
