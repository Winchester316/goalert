<?php
// Get ID of admin
function admin($pdo)
{
    $sqlCheckAdminID = "SELECT uid FROM users WHERE role='1'";
    $checkAdminID = $pdo->query($sqlCheckAdminID);
    $adminID = $checkAdminID->fetch();
    return $adminID['uid'];
}

function sanitize($input)
{
    $input = htmlspecialchars($input);
    $input = stripslashes($input);
    $input = trim($input);
    return $input;
}
