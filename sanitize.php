<?php
// Sanitize form input
function sanitize($input)
{
    $input = htmlspecialchars($input);
    $input = stripslashes($input);
    $input = trim($input);
    return $input;
}
