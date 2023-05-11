<?php
session_start();
if (isset($_SESSION['id'])) {
    echo "session is active";
} else {
    echo "session is inactive";
}
?>