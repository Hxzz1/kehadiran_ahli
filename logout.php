<?php
#session start
session_start();

#clear all session variables
session_unset();

#stop session
session_destroy();

echo"<script>window.location.href='index.php';</script>";
?>