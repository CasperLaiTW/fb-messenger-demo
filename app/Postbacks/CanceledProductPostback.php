<?php

namespace App\Postbacks;

use Casperlaitw\LaravelFbMessenger\Contracts\PostbackHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

class CanceledProductPostback extends PostbackHandler
{
    protected $payload = '^CANCEL_PRODUCT$';

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
        $this->send(new Text($message->getSender(), 'Oops!!! You canceled the product.'));
    }
}
