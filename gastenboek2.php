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
    $file = 'guestbook.json';
    $text = file_get_contents($file, true);
    $fileInput = json_decode($text, true);
    $nameInput = htmlspecialchars($_POST['name']); 
    $messageInput = $_POST['textarea'];
//    If fill empty put 2 brackets in then circle back
    $nameAndMessage = array ("naam" => $nameInput, "message" => $messageInput);
    array_push($fileInput,$nameAndMessage);


    $encode = json_encode($fileInput);
    file_put_contents($file, $encode);
    echo $encode;

?>
