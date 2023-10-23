<html>
<body>

<form method="post">
Naam :<input type="text" name="name"><br>
<textarea type="textarea" name="textarea"></textarea>
<input type="submit">
</form>

</body>
</html> 

<?php 
    include 'guestbook.txt'; 
    $file = 'guestbook.txt';
    $text = file_get_contents($file, true);

    $nameInput = htmlspecialchars($_POST['name']); 
    $messageInput = $_POST['textarea'];


    $nameAndMessage = array("naam" => $nameInput, "message" => $messageInput);

    $encode = json_encode($nameAndMessage);

    file_put_contents($file, $encode);
    echo $encode;

?>
