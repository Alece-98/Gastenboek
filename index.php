<?php
    declare(strict_types = 1);
    include("./classes.php");

    $guestbook = new GuestBook();
    
    if (isset($_POST["name"]) && isset($_POST["comment"])) {
        $guestbook->createMessage($_POST["name"], $_POST["comment"]);
    }

    if (isset($_POST["remove"])) {
        $guestbook->deleteMessage();
    }

    echo $guestbook->displayPage();

?>