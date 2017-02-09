<?php

namespace App\Postbacks;

use Casperlaitw\LaravelFbMessenger\Contracts\PostbackHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ButtonTemplate;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;
use Casperlaitw\LaravelFbMessenger\Messages\User;

class WelcomePostback extends PostbackHandler
{
    /**
     * Define payload (support regex)
     *
     * @var string
     */
    protected $payload = '^WELCOME_MESSAGE$';

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
        $senderId = $message->getSender();

        // Get User Profile
        $user = $this->send(new User($senderId));
        $this->send(new Text($senderId, "Hi, {$user['first_name']}"));

        // Show template
        $this->send($this->createMainMenu($senderId));
    }

    /**
     * @param $senderId
     * @return ButtonTemplate
     */
    public function createMainMenu($senderId)
    {
        // Make button template
        $template = new ButtonTemplate($senderId, 'Product List');
        $template->addPostBackButton('Product 1', 'BUY_PRODUCT_1');
        $template->addPostBackButton('Product 2', 'BUY_PRODUCT_2');
        $template->addPostBackButton('Product 3', 'BUY_PRODUCT_3');

        return $template;
    }
}
