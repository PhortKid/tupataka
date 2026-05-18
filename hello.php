<?php

define("SERVER", "https://sms.quicksoft.co.tz");
define("API_KEY", "f0d7dbd3f1869afe809b9c5d8f8d2b1ff2f6ba92");
 
class sms{
    protected $CI; 
    protected $recipients; 

    public function __construct() { 
        $this->CI =& get_instance(); 
        
        $this->recipients = $this->CI->config->item('smsRecipients');
    }
function send($message)
{
    $url = SERVER . "/services/send.php";
    $postData = array(
        'number' => $this->recipients,
        'message' => $message,
        'schedule' => null,
        'key' => API_KEY,
        'devices' => 0,
        'type' => "sms",
        'attachments' => null,
        'prioritize' => 1
    );
    return $this->sendRequest($url, $postData)["messages"];
}
 
function sendRequest($url, $postData)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);
    if ($httpCode == 200) {
        $json = json_decode($response, true);
        if ($json == false) {
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