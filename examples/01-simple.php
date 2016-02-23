<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;

/**
 * Simple Command
 *
 * The easiest way to get started is to define a single
 * command and add it to the Slack dispatcher.
 *
 * Commands have a token set by Slack that ensures only
 * Slack can send you data. Each command then has one or
 * more patterns that it can match. This allows you to
 * match based on the text users have entered.
 *
 * Responses can be basic text or complete objects.
 **/

$command = Slack::command('ABCDEF01234567');

$command->on('.*', function($req){
	return Slack::response('Hello there!');
});

Slack::dispatcher()
	->addCommand($command)
	->dispatch(Slack::request())
	->serve()
;
