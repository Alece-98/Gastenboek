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
                <label>Naam :
                    <input type="text" name="name" required />
                </label><br>
                <label>
                    bericht :
                    <textarea type="textarea" name="textarea" required></textarea>
                </label>
                <button type="submit">Verstuur bericht</button>
            </form>
            <aside>
                <?php displayGuestbook($decoded); ?>
            </aside>
        </main>
    </body>
</html> 