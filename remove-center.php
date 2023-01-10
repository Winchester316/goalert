<?php
require_once __DIR__ . "/../../config/index.php";
require_once __DIR__ . "/../../functions/index.php";
$code = "";
$message = "";
$ecid = sanitize($_POST['ecid']);
$query = "DELETE FROM admin_centers WHERE ecid=?";
$stmt = $pdo->prepare($query);
if ($stmt->execute([$ecid])) {
    $code = "200";
    $message = "Location successfully removed";
} else {
    $code = "300";
    $message = "System Error!";
}

$data = array('message' => $message, 'code' => $code);
echo json_encode($data);
exit;
