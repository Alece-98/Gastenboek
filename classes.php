<?php
    interface Message {
        public function displayMessage(): string;
    }

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

    class GuestBook implements JsonSerializable {
        private string $fileName = "./guestbook.json";
        private $fileContent;
        public array $errors = ["name" => "", "comment" => ""];

        public function openFile(): void {
            if (!file_exists($this->fileName)) {
                file_put_contents($this->fileName, "{}");
            }

            $fileContent = file_get_contents($this->fileName, true);
            $this->fileContent = json_decode($fileContent, true);
        }

        private function writeFile() {
            $encodedMessages = json_encode($this->fileContent, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
            file_put_contents($this->fileName, $encodedMessages);
        }

        public function displayMessages(): string {
            $messagesString = "";
            foreach($this->fileContent as $message) {
                $currentMessage = new SingleMessage($message["name"], $message["comment"], $message["id"]);
                $messagesString .= $currentMessage->displayMessage();
            }

            return $messagesString;
        }

        private function validateForm(string $name, string $comment): bool {
            $isValid = true;

            if (strlen($name) <= 3 || strlen($name) >= 50) {
                $this->errors["name"] = "Naam moet tussen 3 en 50 karakters bevatten.";
                $isValid = false;
            }

            if (strlen($comment) <= 3 || strlen($comment) >= 256) {
                $this->errors["comment"] = "Bericht moet tussen 3 en 256 karakters bevatten.";
                $isValid = false;
            }
            
            return $isValid;
        }

        public function createMessage(string $name, string $comment) {
            $sanitizedName = htmlspecialchars(trim($name));
            $sanetizedComment = htmlspecialchars(trim($comment));

            $isValid = $this->validateForm($sanitizedName, $sanetizedComment);

            if ($isValid) {
                $message = new SingleMessage($sanitizedName, $sanetizedComment, uniqid());
                array_push($this->fileContent, (array)$message);
                $this->writeFile();
            }
        }

        public function deleteMessage() {
            $this->fileContent = array_filter($this->fileContent, function ($currentMessage) {
                return $currentMessage["id"] !== $_POST["remove"];
            });

            $this->writeFile();
        }

        private function displayForm() {
            $formTemplate = file_get_contents("./templates/form.html", true);
            $replace = ["{nameError}", "{commentError}"];
            $values = [$this->errors["name"], $this->errors["comment"]];
            return str_replace($replace, $values, $formTemplate);
        }

        public function displayPage() {
            $mainTemplate = file_get_contents("./templates/main.html", true);
            $replace = ["{content}"];
            $value = "";
            $value .= $this->displayForm();
            $value .= $this->displayMessages();

            return str_replace($replace, $value, $mainTemplate);
        }

        public function jsonSerialize(): mixed
        {
            return get_object_vars($this);
        }

        public function __construct()
        {
            $this->openFile();
        }
    }
?>