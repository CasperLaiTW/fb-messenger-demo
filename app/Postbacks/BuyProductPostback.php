<?php

namespace App\Postbacks;

use Casperlaitw\LaravelFbMessenger\Contracts\PostbackHandler;
use Casperlaitw\LaravelFbMessenger\Messages\QuickReply;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

/**
 * Class BuyProductPostback
 * @package App\Postbacks
 */
class BuyProductPostback extends PostbackHandler
{
    /**
     * Payload
     *
     * @var string
     */
    protected $payload = '^BUY_PRODUCT_(?P<product>\d+)$';

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
        $productionId = $this->getProductionId($message->getPostback());
        $text = new Text($message->getSender(), "Do you want to get product {$productionId}");
        $text->addQuick(new QuickReply('Yes', "CONFIRMED_PRODUCT_{$productionId}"));
        $text->addQuick(new QuickReply('No', 'CANCEL_PRODUCT'));
        $this->send($text);
    }

    /**
     * Get product id
     *
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
