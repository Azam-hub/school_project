<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header("location: login.php");
}

?>
<div class="sidebar">
    <div class="top">
        <a href="index.php">
            <img src="src/static_images/admin-without-bg.png" alt="Pic">
            <h3>Admin Panel</h3>
        </a>
    </div>
    <div class="bottom">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="information.php">Information</a></li>
            <li><a href="news-and-events.php">News and Events</a></li>
            <li><a href="job-application.php">Job Applications</a></li>
            <li><a href="messages.php">Messages</a></li>
        </ul>
    </div>
    <i class="icon fa-solid fa-xmark"></i>
</div>