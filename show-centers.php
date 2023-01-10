<?php
require_once __DIR__ . "/../../config/index.php";
require_once __DIR__ . "/../../functions/index.php";

// Session Keys
$session_id = $_SESSION['uid'];
$session_brgy = $_SESSION['barangay'];

$template = "";

$query = "SELECT ac.*,au.barangay FROM admin_centers ac LEFT JOIN admin_users au ON ac.uid=au.uid WHERE ac.uid=? AND au.barangay=? ORDER BY ac.date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$session_id, $session_brgy]);
$centers = array();
while ($row = $stmt->fetch()) {
    $centers[$row['barangay']][] = $row;
}

foreach ($centers as $barangay => $center_list) {
    $template .=
        "<div class='d-grid gap-0'>
                                                        <span class='fw-bold'>Brgy. {$barangay} Evacuation Centers</span>
                                                        <span class='text-muted text-sm'>Here are the complete list of evacuation centers within your barangay area.</span>
                                                        <ul class='list-unstyled row row-cols-md-2 row-cols-lg-3 gap-3 mt-4'>";

    foreach ($center_list as $center) {
        $is_updated = ($center['is_updated'] == '1') ? "updated" : "added";
        $strDate = strtotime($center['date']);
        $date1 = date("F j, Y", $strDate);
        $date2 = date("Y-m-d", $strDate);
        $date3 = date("H:i:s", $strDate);
        $formatted_date = "<time class='timeago' datetime='{$date2}T{$date3}+08:00'>{$date1}</time>";
        $template .=
            "<li class='list-item'><form method='POST' action=''>
                                                                <div class='d-flex align-items-baseline gap-2'>
                                                                <input type='hidden' value='{$center['ecid']}' class='ecid' name='ecid'/>
                                                                <button type='submit' class='remove-center btn btn-sm btn-danger rounded-pill w-max position-relative has-tooltip tooltip-bottom' data-tooltip='Remove {$center['description']}'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-20px h-20px'><path stroke-linecap='round' stroke-linejoin='round' d='M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0' /></svg></button>
                                                                <div class='d-grid lh-1 gap-1'>
                                                                <a href='#' class='text-decoration-none link-warning fw-semibold text-wrap d-flex align-items-baseline gap-1 position-relative has-tooltip tooltip-bottom' data-tooltip='view in map' id='staticTitle'>{$center["description"]}</a>
                                                                <span class='text-muted text-sm'>{$is_updated} {$formatted_date} ago</span>
                                                                </div>
                                                                </div>
                                                            </form></li>";
    }
    $template .= "</ul></div>";
}

$data = array(
    'template' => $template,
);
echo json_encode($data);
