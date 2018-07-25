<?php
namespace App\Traits\Api;

trait ApiResponseTrait {

    protected $data;
    private $isError = false;
    private $error_code = null;
    private $error_message = '';
    private $details = [];

    /**
     * @return array
     */
    public function makeResponse() {
        return $this->data;
    }
}