<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;

/**
 * Multiple Commands
 *
 * Each dispatcher can handle multiple commands. Simply
 * pass each command to the dispatcher and it wll work out
 * which command to use.
 **/

$command1 = Slack::command('ABCDEF01234567');
$command1->on('.*', function($req){
	return Slack::response('Hello from command one!');
});

$command2 = Slack::command('XYZ789');
$command2->on('.*', function($req){
	return Slack::response('Hello from command two!');
});

$command3 = Slack::command('ABC789');
$command3->on('.*', function($req){
	return Slack::response('Hello from command three!');
});

Slack::dispatcher()
	->addCommand($command1)
	->addCommand($command2)
	->addCommand($command3)
	->dispatch(Slack::request())
	->serve()
;
