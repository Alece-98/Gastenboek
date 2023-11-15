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

        private function displayError(): array {
            $values = [];
            foreach($this->errors as $error) {
                if(!empty($error)) {

                    $errorTemplate = file_get_contents("./templates/errorMessage.html");
                    
                    $replace = "{errorMessage}";

                    $result = str_replace($replace, $error, $errorTemplate);
                    array_push($values, $result); 
                } else {
                    array_push($values, "");
                }
            }
            return $values;
        }
        
        private function displayForm(): string {
            $formTemplate = file_get_contents("./templates/form.html", true);
            $replace = ["{nameError}", "{commentError}"];
            $values = $this->displayError();
            return str_replace($replace, $values, $formTemplate);
        }

        protected function displayWebPage(): void {
            $mainTemplate = file_get_contents("./templates/main.html", true);
            $replace = ["{form}", "{messages}"];
            $values = [$this-> displayForm(), $this->displayMessages()];

            echo str_replace($replace, $values, $mainTemplate);
        }


    }
?>