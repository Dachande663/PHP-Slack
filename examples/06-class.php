<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;
use HybridLogic\Slack\SlashCommand;

/**
 * Class Commands
 *
 * Instead of defining commands using the Slack::command
 * method, you can also provide a class. Each class
 * requires a $token and $patterns property. The patterns
 * work just like the on() call before and define which
 * methods to call based on the input text.
 **/

class ExampleCommand extends SlashCommand {

	protected $token = 'ABCDEF01234567';

	protected $patterns = [
		'' => 'actionIndex',
		'^hello ( .+)?' => 'actionHello',
	];

	public function actionIndex($req) {
		return 'Welcome to this command';
	}

	public function actionHello($req) {
		return 'Hello ' . $req->param(0);
	}

}

Slack::dispatcher()
	->addCommand(new ExampleCommand)
	->dispatch(Slack::request())
	->serve()
;
