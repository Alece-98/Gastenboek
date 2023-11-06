<?php    
    class SingleMessage implements Message {
        public string $name;
        public string $comment;
        public string $id;

        public function displayMessage(): string
        {
            $replace = array("{name}", "{comment}", "{id}");
            $values = array(
                $this->name,
                $this->comment,
                $this->id
            );
            $template = file_get_contents("./templates/message.html", true);

            return str_replace($replace, $values, $template);
        }

        public function __construct(string $name, string $comment, string $id)
        {
            $this->name = $name;
            $this->comment = $comment;
            $this->id = $id;
        }
    }
?>