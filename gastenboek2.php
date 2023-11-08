<?php 
    declare(strict_types = 1); 
    define("FILE", 'guestbook.json');

    function openFile(): array {
        $text = file_get_contents(FILE, true);
        if (empty($text)) $text = "[]";
        return json_decode($text, true);
    }

    function createPost($fileInput): array {
        $nameInput = htmlspecialchars($_POST['name']); 
        $messageInput = htmlspecialchars($_POST['textarea']);
        $id = 1;
        if (!empty($fileInput)) {
            $lastMessage = end($fileInput);
            $id = ($lastMessage["id"] + 1);
        }
    
        $nameAndMessage = array("name" => $nameInput, "message" => $messageInput, "id" => $id);
        array_push($fileInput,$nameAndMessage);
    
        $encode = json_encode($fileInput);
        file_put_contents(FILE, $encode);
        
        return $fileInput;
    }

    function removePost() {
        echo $_POST["remove"];
    }

    function displayGuestbook($fileInput): void {
        $output = "";
        foreach ($fileInput as $guestMessage) {
            echo "<article>" ,"</form>",
            "<div id='messageDiv'><h2 id='messageName'>",
            $guestMessage["name"],
            "</h2>",
            "<p id='message'>",
            $guestMessage["message"],
            "</p></div>",
            "<form id='deletebutton' method='post'>",
            "<button name='remove'id='deletebutton' title='Verwijder' type='submit' value='",
            $guestMessage["id"],
            "'>X</button >",
            "</article>";
        }
        echo $output;
    }
?>
