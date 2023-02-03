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

  $opt1 = ($_SESSION['role'] == '2') ? "WHERE u.barangay=? AND u.role='2' AND ac.is_archived='0'" : "WHERE ac.is_archived='0'";
  $opt2 = ($_SESSION['role'] == '2') ? "WHERE r.barangay=? AND rc.is_archived='0'" : "WHERE rc.is_archived='0'";

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
    ac.mid,
    ac.latitude,
    ac.longitude,
    ac.description,
    ac.type,
    ac.level,
    ac.magnitude,
    ac.severity,
    ac.affected 
    FROM admin_users u 
    INNER JOIN admin_coordinates ac 
    ON u.uid=ac.uid 
    {$opt1}
UNION
SELECT 
    r.uid,
    r.firstname,
    r.middlename,
    r.lastname,
    r.gender,
    r.house_number,
    r.zone,
    r.barangay,
    r.mobile,
    r.avatar,
    r.role,
    rc.mid,
    rc.latitude,
    rc.longitude,
    rc.description,
    rc.type,
    rc.level,
    rc.magnitude,
    rc.severity,
    rc.affected 
    FROM resident_users r 
    INNER JOIN resident_coordinates rc 
    ON r.uid=rc.uid 
    {$opt2}
";
  $brgy = $_SESSION['barangay'];
  $result = $pdo->prepare($query);
  if ($_SESSION['role'] == '2') {
    $result->execute([$brgy, $brgy]);
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
    $addtl = ($_SESSION['role'] == '1' || $_SESSION['role'] == '2') ? ' level="' . parseToXML($row['level']) . '"  magnitude="' . parseToXML($row['magnitude']) . '" ' . ' severity="' . parseToXML($row['severity']) . '" ' : ' ';
    // Add to XML document node
    echo '
    <marker ';
    echo ' coor_mid="' . parseToXML($row['mid']) . '" ';
    echo ' coor_uid="' . parseToXML($row['uid']) . '" ';
    echo ' lat="' . parseToXML($row['latitude']) . '" ';
    echo ' lng="' . parseToXML($row['longitude']) . '" ';
    echo ' type="' . parseToXML($row['type']) . '" ';
    echo $addtl;
    echo ' affected="' . parseToXML($row['affected']) . '" ';
    echo ' description="' . parseToXML($row['description']) . '" ';
    echo ' users_uid="' . parseToXML($row['uid']) . '" ';
    echo ' fname="' . parseToXML($row['firstname']) . '" ';
    echo ' mname="' . parseToXML($row['middlename']) . '" ';
    echo ' lname="' . parseToXML($row['lastname']) . '" ';
    echo ' gender="' . parseToXML($row['gender']) . '" ';
    echo ' house_number="' . parseToXML($row['house_number']) . '" ';
    echo ' zone="' . parseToXML($row['zone']) . '" ';
    echo ' barangay="' . parseToXML($row['barangay']) . '" ';
    echo ' mobile="' . parseToXML($row['mobile']) . '" ';
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
