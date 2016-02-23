<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;

/**
 * Responses
 *
 * Commands can return a text string or array of data that
 * is served to Slack. A fluent response builder is also
 * available for setting response options.
 *
 * By default all responses are visible only to the user
 * who made them. They can be set to visible to all in the
 * channel by calling isPublic (and conversely isPrivate).
 *
 * Additionally zero or more attachments can be added via
 * addAttachment(s). More information can be found on
 * [slack](https://api.slack.com/docs/attachments).
 **/

$command = Slack::command('ABCDEF01234567');

$command->on('text', function($req){
	return Slack::response('Hello there!');
});

$command->on('array', function($req){
	return Slack::response([
		'text' => 'My text',
		'attachments' => [
			'title' => 'Attachment Title',
		],
	]);
});

$command->on('fluent', function($req){
	return Slack::response('Hello there!')
		->isPublic()
		->addAttachment([
			'title' => 'Attachment Title',
			'color' => 'good',
		]);
});

Slack::dispatcher()
	->addCommand($command)
	->dispatch(Slack::request())
	->serve()
;
