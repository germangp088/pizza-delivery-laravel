<?php

namespace App;

class Result
{
    private $success;
    private $message;
    private $status;

    public function build($success, $message = '', $status = 200){
        $this->success = $success;
        $this->message = $message;
        $this->status = $status;
    }

    private function setSuccess($success) {
        $this->success = $success;
    }

    private function setMessage($message) {
        $this->message = $message;
    }

    private function setStatus($status) {
        $this->status = $status;
    }

    private function getSuccess() {
        return $this->success;
    }

    private function getMessage() {
        return $this->message;
    }

    private function getStatus() {
        return $this->status;
    }

    public function __set($name,$value) {
        switch($name) {
            case 'success':
                return $this->setSuccess($value);
            case 'message':
                return $this->setMessage($value);
            case 'status':
                return $this->setStatus($value);
        }
      }

    public function __get($name) {
        switch($name) {
            case 'success':
                return $this->getSuccess();
            case 'message':
                return $this->getMessage();
            case 'status':
                return $this->getStatus();
        }
      }
}
