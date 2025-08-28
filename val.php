<?php
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_password($password) {
    return strlen($password) >= 6; 
}
?>
