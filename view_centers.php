<?php
require_once __DIR__ . "/../../config/index.php";

// Check if logged in account is admin(not resident)
// Chack also if session 'map' is set from the map.php
if ($_SESSION['role'] == '1' || $_SESSION['role'] == '2') {

  function parseToXML($htmlStr)
  {
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $htmlStr);
    $xmlStr = str_replace('"', '', $htmlStr);
    $xmlStr = str_replace("'", '', $htmlStr);
    $xmlStr = str_replace("&", 'and', $htmlStr);
    return $xmlStr;
  }

  $opt1 = ($_SESSION['role'] == '2') ? "WHERE u.barangay=? AND u.role='2' AND ac.is_archived='0'" : "WHERE u.is_atchived='0'";

  // Select all the rows in the markers table
  $query = "SELECT 
    u.uid,
    u.firstname,
    u.middlename,
    u.lastname,
    u.gender,
    u.house_number,
    u.zone,
    u.barangay,
    u.mobile,
    u.avatar,
    u.role,
    ac.ecid,
    ac.latitude,
    ac.longitude,
    ac.description,
    ac.capacity,
    ac.occupancy
    FROM admin_users u 
    INNER JOIN admin_centers ac 
    ON u.uid=ac.uid 
    {$opt1}";
  $brgy = $_SESSION['barangay'];
  $result = $pdo->prepare($query);
  if ($_SESSION['role'] == '2') {
    $result->execute([$brgy]);
  } else {
    $result->execute();
  }
  $rows = $result->fetchAll();
  if (!$rows) {
    die();
  }

  header("Content-type: text/xml");

  // Start XML file, echo parent node
  echo "<?xml version='1.0' ?>";
  echo '<markers>';
  $ind = 0;
  // Iterate through the rows, printing XML nodes for each
  foreach ($rows as $row) {
    // Add to XML document node
    echo '
    <marker ';
    echo ' coor_ecid="' . parseToXML($row['ecid']) . '" ';
    echo ' coor_uid="' . parseToXML($row['uid']) . '" ';
    echo ' lat="' . parseToXML($row['latitude']) . '" ';
    echo ' lng="' . parseToXML($row['longitude']) . '" ';
    echo ' description="' . parseToXML($row['description']) . '" ';
    echo ' capacity="' . parseToXML($row['capacity']) . '" ';
    echo ' occupancy="' . parseToXML($row['occupancy']) . '" ';
    echo ' users_uid="' . parseToXML($row['uid']) . '" ';
    echo ' fname="' . parseToXML($row['firstname']) . '" ';
    echo ' mname="' . parseToXML($row['middlename']) . '" ';
    echo ' lname="' . parseToXML($row['lastname']) . '" ';
    echo ' gender="' . parseToXML($row['gender']) . '" ';
    echo ' zone="' . parseToXML($row['zone']) . '" ';
    echo ' barangay="' . parseToXML($row['barangay']) . '" ';
    echo ' avatar="' . parseToXML($row['avatar']) . '" ';
    echo ' role="' . parseToXML($row['role']) . '" ';
    echo ' />';
    $ind = $ind + 1;
  }

  // End XML file
  echo '
</markers>';
  // delete the session 'map'
  unset($_SESSION['map']);
} else {
  header("Location: ../404.html");
  exit;
}
