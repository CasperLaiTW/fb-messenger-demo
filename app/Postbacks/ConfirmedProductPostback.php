<?php

namespace App\Postbacks;

use Casperlaitw\LaravelFbMessenger\Contracts\PostbackHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

/**
 * Class ConfirmedProductPostback
 * @package App\Postbacks
 */
class ConfirmedProductPostback extends PostbackHandler
{
    /**
     * @var string
     */
    protected $payload = '^CONFIRMED_PRODUCT_(?P<product>\d+)$';

    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException
     */
    public function handle(ReceiveMessage $message)
    {
        $productId = $this->getProductionId($message->getPostback());
        $this->send(new Text($message->getSender(), "Thank you for buying Product {$productId}"));
    }

    /**
     * @param $postback
     * @return mixed
     */
    private function getProductionId($postback)
    {
        if (preg_match("/{$this->payload}/", $postback, $matches)) {
            return $matches['product'];
        }
    }
}
