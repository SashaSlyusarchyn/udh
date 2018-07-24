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
        return [
            'data' => $this->data,
            'isError' => $this->isError,
            'errors' => [
                [
                    'code' => $this->error_code,
                    'message' => $this->error_message,
                    'details' => $this->details
                ]
            ]
        ];
    }

    /**
     * @param int $error_code
     * @param string $error_message
     * @param array $error_details
     */
    public function pushError(int $error_code, string $error_message, array $error_details) {
        $this->isError = true;
        $this->error_code = $error_code;
        $this->error_message = $error_message;
        $this->details[] = $error_details;
    }
}