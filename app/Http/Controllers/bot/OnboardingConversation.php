<?php

namespace App\Http\Controllers\bot;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class OnboardingConversation extends Conversation
{
    protected $firstname;

    protected $email;

  public function stopsConversation(IncomingMessage $message)
	{
		if ($message->getText() == 'stop') {
			return true;
		}

		return false;
	}


	public function skipsConversation(IncomingMessage $message)
	{
		if ($message->getText() == 'pause') {
			return true;
		}

		return false;
	}

    // ...

}