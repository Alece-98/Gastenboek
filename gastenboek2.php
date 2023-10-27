<?php 
    declare(strict_types = 1); 
    define("FILE", 'guestbook.json');

    function openFile(): array {
        $text = file_get_contents(FILE, true);
        if (empty($text)) $text = "[]";
        // If file empty put 2 brackets in then circle back
        return json_decode($text, true);
    }

    function createPost($fileInput): array {
        $nameInput = htmlspecialchars($_POST['name']); 
        $messageInput = htmlspecialchars($_POST['textarea']);
    
        $nameAndMessage = array("name" => $nameInput, "message" => $messageInput);
        array_push($fileInput,$nameAndMessage);
    
        $encode = json_encode($fileInput);
        file_put_contents(FILE, $encode);
        
        return $fileInput;
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
            $output .= "</article>";
        }
        echo $output;
    }
?>
