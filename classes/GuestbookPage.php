<?php
    class GuestbookPage extends GuestbookFile {
        private function displayMessages(): string {
            $output = "";
            $messages = $this->getMessages();
            foreach($messages as $message) {
                $currentMessage = new SingleMessage($message["name"], $message["comment"], $message["id"]);
                $output .= $currentMessage->displayMessage();
            }
            
            return $output;
        }
        
        private function displayForm() {
            $formTemplate = file_get_contents("./templates/form.html", true);
            $replace = ["{nameError}", "{commentError}"];
            $values = [$this->errors["name"], $this->errors["comment"]];
            return str_replace($replace, $values, $formTemplate);
        }

        protected function displayPage() {
            $mainTemplate = file_get_contents("./templates/main.html", true);
            $replace = ["{content}"];
            $value = "";
            $value .= $this->displayForm();
            $value .= $this->displayMessages();

            echo str_replace($replace, $value, $mainTemplate);
        }


    }
?>