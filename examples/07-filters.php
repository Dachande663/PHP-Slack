<?php

include '../autoload.php';

use HybridLogic\Slack\SlackFactory as Slack;

/**
 * Filters
 *
 * Sometimes you only want certain people to be able to
 * talk to your commands. The SlashFilter class makes this
 * simple.
 *
 * You can filter by team IDs, channel IDs and user IDs.
 * Filters can be attached to individual commands or the
 * entire dispatcher (or both if you want to have more fine
 * -grained control).
 **/


$filter1 = Slack::filter();
$filter1->allowedTeamIds('T01234567');
$filter1->allowedChannelIds('C01234567');

$dispatcher = Slack::dispatcher();
$dispatcher->setFilter($filter1);

$command1 = Slack::command('ABCDEF01234567');
$command1->on('.*', function($req){
	return Slack::response('Anyone on the team can use this command in a set channel.');
});

$filter2 = Slack::filter();
$filter2->allowedUserIds(['U01234567', 'U24682468']);

$command2 = Slack::command('ABCDEF01234567');
$command2->setFilter($filter2);
$command2->on('.*', function($req){
	return Slack::response('Only certain users can use this command.');
});

$dispatcher->addCommand($command1);
$dispatcher->addCommand($command2);
$dispatcher->dispatch(Slack::request());
$dispatcher->serve();
