<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;

/**
 * Pattern Matching
 *
 * When a command is executed on Slack, any accompanying
 * text is also sent e.g.
 *
 *    /example my name is John
 *
 * would provide the text "my name is John". This can be
 * used to match against within each command. Patterns are
 * evaluated with exact matches first and then in the order
 * they are defined and support full PCRE syntax.
 *
 * If no text is provided, an empty string is matched.
 **/

$command = Slack::command('ABCDEF01234567');

# /example
$command->on('', function($req){
	return Slack::response('This message will be shown if no text is entered');
});

# /example hello
$command->on('hello', function($req){
	return Slack::response('And hello to you too');
});

# /example my name is Test
$command->on('^my name is (.+)', function($req){
	// patterns can contain regular expressions
	// any matched params are available via param
	return Slack::response('Hello ' . $req->param(0) . '!');
});

# /example anything else
$command->on('.*', function($req){
	return Slack::response('This will match anything');
});

Slack::dispatcher()
	->addCommand($command)
	->dispatch(Slack::request())
	->serve()
;
