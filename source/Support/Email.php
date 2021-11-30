<?php

namespace Source\Support;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use stdClass;

class Email
{
    private PHPMailer $mail;
    private stdClass $data;
    private Exception $error;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->data = new stdClass();

        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->setLanguage('br');

        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = 'tls';
        $this->mail->CharSet = 'utf-8';

        $this->mail->Host = EMAIL_CONFIG['host'];
        $this->mail->Username = EMAIL_CONFIG['username'];
        $this->mail->Password = EMAIL_CONFIG['password'];
        $this->mail->Port = EMAIL_CONFIG['port'];
    }

    public function add(string $subject, string $body,
        string $recipient_name, string $recipient_email): Email
    {
        $this->data->subject = $subject;
        $this->data->body = $body;
        $this->data->recipient_name = $recipient_name;
        $this->data->recipient_email = $recipient_email;

        return $this;
    }

    public function attach(string $file_path, string $file_name): Email
    {
        $this->data->attach[$file_path] = $file_name;

        return $this;
    }

    public function send(string $from_name = EMAIL_CONFIG['from_name'],
        string $from_email = EMAIL_CONFIG['from_email']): bool
    {
        try {

            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
            $this->mail->setFrom($from_email, $from_name);

            if (!empty($this->data->attach)) {

                foreach ($this->data->attach as $path => $name) {

                    $this->mail->addAttachment($path, $name);
                }
            }

            $this->mail->send();
            return true;

        } catch (Exception $e) {

            $this->error = $e;

            return false;
        }
    }

    public function error(): ?Exception
    {
        return isset($this->error) ? $this->error : null;
    }

}