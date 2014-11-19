<?php
/**
 * Delete a voting
 *
 * @package voting
 */

$guid = get_input('guid');
$voting = get_entity($guid);

if (elgg_instanceof($voting, 'object', 'voting') && $voting->canEdit()) {
	$container = $voting->getContainerEntity();
	if ($voting->delete()) {
		system_message(elgg_echo("voting:delete:success"));
		if (elgg_instanceof($container, 'group')) {
			forward("voting/group/$container->guid/all");
		} else {
			forward("voting/owner/$container->username");
		}
	}
}

register_error(elgg_echo("voting:delete:failed"));
forward(REFERER);
