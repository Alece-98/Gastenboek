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
            $output .= "<article>";
            $output .= "<h2>";
            $output .= $guestMessage["name"];
            $output .= "</h2>";
            $output .= "<p>";
            $output .= $guestMessage["message"];
            $output .= "</p>";
            $output .= "<form method='post'>";
            $output .= "<button name='remove' type='submit' value='";
            $output .= $guestMessage["id"];
            $output .= "'>verwijder</button>";
            $output .= "</form>";
            $output .= "</article>";
        }
        echo $output;
    }
?>
