<?php

namespace App\Service;

use Twilio\Rest\Client;



class TwilioService
{
    private $client;
    private $fromNumber;

    public function __construct(string $accountSid, string $authToken, string $fromNumber)
    {
        $this->client = new Client($accountSid, $authToken);
        $this->fromNumber = $fromNumber;
    }

    public function sendMessage(string $to, string $message)
    {
        $this->client->messages->create(
            $to,
            array(
                'from' => $this->fromNumber,
                'body' => $message
            )
        );
    }
}
