<?php

namespace App\Handlers;

use App\Postbacks\WelcomePostback;
use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

class ShowProductMenuHandler extends BaseHandler
{

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
        if ($message->getMessage() === 'Show Menu') {
            $senderId = $message->getSender();
            $this->send(new Text($senderId, 'It is my menu list'));

            $postback = new WelcomePostback();
            $this->send($postback->createMainMenu($senderId));
        }
    }
}
