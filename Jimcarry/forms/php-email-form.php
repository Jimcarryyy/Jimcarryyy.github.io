<?php
class PHP_Email_Form {
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $ajax;
    private $messages = array();

    public function add_message($content, $label, $priority = 0) {
        $this->messages[] = array('content' => $content, 'label' => $label, 'priority' => $priority);
    }

    public function send() {
        $headers = "From: " . $this->from_name . " <" . $this->from_email . ">\r\n";
        $headers .= "Reply-To: " . $this->from_email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        $message = "";
        foreach ($this->messages as $msg) {
            $message .= $msg['label'] . ": " . $msg['content'] . "\n";
        }

        return mail($this->to, $this->subject, $message, $headers);
    }
}
?>
