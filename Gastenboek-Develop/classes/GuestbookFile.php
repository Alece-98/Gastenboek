<?php
    class GuestbookFile implements JsonSerializable {
        private string $fileName = "./guestbook.json";
        private array $messages = [];
        protected array $errors = ["name" => "", "comment" => ""];

        public function openFile(): void {
            if (!file_exists($this->fileName)) {
                file_put_contents($this->fileName, "{}");
            }

            $fileContent = file_get_contents($this->fileName, true);
            $this->messages = json_decode($fileContent, true);
        }

        public function getMessages(): array {
            return $this->messages;
        }

        protected function validateMessage(string $name, string $comment) {
            $sanitizedName = htmlspecialchars(trim($name));
            $sanitizedComment = htmlspecialchars(trim($comment));

            $validation = new MessageValidation($sanitizedName, $sanitizedComment);
            $errors = $validation->getErrors();

            if (empty($errors["name"]) && empty($errors["comment"])) {
                $this->createMessage($sanitizedName, $sanitizedComment);
            } else {
                $this->errors = $errors;
            }
        }

        private function createMessage(string $name, string $comment): void {
            $newMessage = new SingleMessage($name, $comment, uniqid());
            array_push($this->messages, (array)$newMessage);
            $this->writeFile();
        }

        protected function removeMessage() {
            $this->messages = array_filter($this->messages, function($currentMessage) {
                return $currentMessage["id"] !== $_POST["remove"];
            });
            $this->writeFile();
        }

        private function writeFile() {
            $encodedMessages = json_encode($this->messages, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
            file_put_contents($this->fileName, $encodedMessages);
        }


        public function jsonSerialize(): mixed
        {
            return get_object_vars($this);
        }
    }
?>