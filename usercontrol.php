<?php
#checking session variable value[level]
if (!empty($_SESSION['level'])) {
    if ($_SESSION['level'] != "USER") {
        #if not same value with user = stopped
        die("<script>alert('sila login');
        window.location.href='logout.php';</script>");
    }
} else {
    # if session empty.
    die("<script>alert('sila login');
    window.location.href='logout.php';</script>");
}
?>