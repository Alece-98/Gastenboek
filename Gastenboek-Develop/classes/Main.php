<?php
    class Main extends GuestbookPage {

        private function messagePost(): void {
            if (isset($_POST["name"]) && isset($_POST["comment"])) {
                $this->validateMessage($_POST["name"], $_POST["comment"]);
            }
        }

        private function deleteMessage(): void {
            if (isset($_POST["messageID"])) {
                $this->removeMessage();
            }
        }

        public function __construct()
        {
            $this->openFile();
            $this->messagePost();
            $this->deleteMessage();
            $this->displayWebPage();
        }
    }
?>