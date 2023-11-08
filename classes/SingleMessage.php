<?php    
    class SingleMessage implements Message {
        public string $name;
        public string $comment;
        public string $id;

        private function addDeleteButton(): string {
            // rename session key when login is implemented
            if (isset($_SESSION["admin"])) {
                $template = file_get_contents("./templates/deleteButton.html", true);
                return str_replace("{id}", $this->id, $template);
            }
            
            return "";
        }

        public function displayMessage(): string
        {
            $replace = array("{name}", "{comment}", "{deleteButton}");
            $values = array(
                $this->name,
                $this->comment,
                $this->addDeleteButton()
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