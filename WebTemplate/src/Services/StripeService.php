<?php

namespace App\Services;

use App\Entity\Event;


class StripeService {
    private $privateKey;

    public function __construct()
    {
        $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
    }

    
}