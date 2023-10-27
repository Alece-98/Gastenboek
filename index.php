<?php
    declare(strict_types = 1);
    include("./gastenboek2.php");
    $decoded = openFile();
    if (isset($_POST["name"]) && isset($_POST["textarea"])) {
        $decoded = createPost($decoded);
    }
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <title>Gastenboek</title>
    </head>
    <body>
        <main>
        <form method="post">
            Naam :<input type="text" name="name" required><br>
            <textarea type="textarea" name="textarea" required></textarea>
            <input type="submit">
        </form>
        <aside>
            <?php displayGuestbook($decoded); ?>
        </aside>
        </main>
    </body>
</html> 