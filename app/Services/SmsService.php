<?php

namespace App\Services;

use Exception;

class SmsService
{
    protected $server;
    protected $apiKey;
    protected $defaultRecipient;

    public function __construct()
    {
        $this->server = env('SMS_SERVER');
        $this->apiKey = env('SMS_API_KEY');
        $this->defaultRecipient = env('SMS_DEFAULT_RECIPIENT');
    }

    /**
     * Tuma SMS
     *
     * @param string $message
     * @param string|null $recipient
     * @return mixed
     * @throws Exception
     */
    public function send($message, $recipient = null)
    {
        $url = $this->server . "/services/send.php";
        $postData = [
            'number' => $recipient ?? $this->defaultRecipient,
            'message' => $message,
            'schedule' => null,
            'key' => $this->apiKey,
            'devices' => 0,
            'type' => "sms",
            'attachments' => null,
            'prioritize' => 1
        ];

        return $this->sendRequest($url, $postData)["messages"];
    }

    /**
     * Fanya HTTP request kwa kutumia cURL
     *
     * @param string $url
     * @param array $postData
     * @return mixed
     * @throws Exception
     */
    protected function sendRequest($url, $postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));

        // Skip SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);

        if ($httpCode == 200) {
            $json = json_decode($response, true);

            if ($json === false) {
                if (empty($response)) {
                    throw new Exception("Missing data in request. Please provide all the required information to send messages.");
                } else {
                    throw new Exception($response);
                }
            } else {
                if ($json["success"]) {
                    return $json["data"];
                } else {
                    throw new Exception($json["error"]["message"]);
                }
            }
        } else {
            throw new Exception("HTTP Error Code : {$httpCode}");
        }
    }
}
