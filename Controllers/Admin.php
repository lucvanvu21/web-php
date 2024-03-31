<?php
// session_start();

if ($_SESSION['level'] != 2) {
    header("Location: index.php?task=pagehome");
    exit();
}
