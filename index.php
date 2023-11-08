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

<link rel="stylesheet" type="text/css" href="style.css" /> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Lobster&display=swap" rel="stylesheet"> 
<link href="vendor/emoji-picker/lib/css/emoji.css" rel="stylesheet">
    </head>
    <body>
        <header>
        <h1 id="guestbook"> Gastenboek </h1>
        <div id="navdiv">
        <nav> 
            <button> Home </button>
            <button> Gastenboek </button>
            <button> Photos & Videos </button>
            <button> Something </button>   
        </nav>
        </div>  
        </header>
        <main>
            <div id="mainpage">
            <div id="postDiv">
            <form id="formDiv" method="post">
                <!-- <h2 id="text"> Laat een leuk berichtje achter! </h2> -->
                <label id="naam" >
                    
                    <input id="nameArea" type="text" placeholder="Naam:"name="name" required />
                </label><br>
                <label id="bericht">
                    
                    <textarea id="textArea" placeholder="Laat een bericht achter:"type="textarea"  name="textarea" required></textarea>
                </label>
                <button type="submit" id="verstuurButton">Verstuur bericht</button>
            </form>
            </div>
            
            <aside>
                <div id="messages">
                <?php displayGuestbook($decoded); ?>
                </div>
            </aside>
</div>
        </main>
        <footer id="footer">
            <p> Copyright </p>
        </footer>

  <!-- ------------------ -->
    </body>
</html> 