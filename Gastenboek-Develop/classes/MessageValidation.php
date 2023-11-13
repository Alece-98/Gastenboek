<?php
    class MessageValidation {
        private array $errors = ["name" => "", "comment" => ""];
        
        private function validateNameLength(string $name): void {
            $min = 3;
            $max = 50;
            $nameLength = strlen($name);
            
            if($nameLength < $min || $nameLength > $max) {
                $this->errors["name"] = "&#128308; Naam moet tussen de 3 en 50 karakters zijn! &#128308;";
            }
        }

        private function validateCommentLength(string $comment): void {
            $min = 3;
            $max = 256;
            $commentLength = strlen($comment);
            
            if($commentLength < $min || $commentLength > $max){
                $this->errors["comment"] = "&#128308; Bericht moet tussen de 3 en 256 karakters zijn! &#128308;";
            }
        }

        public function getErrors() {
            return $this->errors;
        }

        public function __construct(string $name, string $comment)
        {
            $this->validateNameLength($name);
            $this->validateCommentLength($comment);
        }

        
    }
?>