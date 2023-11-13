<?php
    class Main extends GuestbookPage {

        private function messagePost() {
            if (isset($_POST["name"]) && isset($_POST["comment"])) {
                $this->validateMessage($_POST["name"], $_POST["comment"]);
            }
        }

        private function deleteMessage() {
            if (isset($_POST["remove"])) {
                $this->removeMessage();
            }
        }

        public function __construct()
        {
            $this->openFile();
            $this->messagePost();
            $this->deleteMessage();
            $this->displayPage();
        }
    }
?>