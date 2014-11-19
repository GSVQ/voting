<?php

/**
 * voting/pages/voting/edit.php
 * 
 *
 */

gatekeeper();

elgg_push_breadcrumb($title);
$guid = get_input('guid');
$voting = get_entity($guid);
if ($voting) {
$votes = $voting->getAnnotations('votes');
}
if ($votes) {
	register_error(elgg_echo('voting:error:thereis:votes'));
	forward(REFERER);
	
}else {
	if (!$voting) {
		$title = elgg_echo('voting:add');
		$vars = voting_prepare_form_vars($voting);
		
		$content = elgg_view_form('voting/edit', array(), $vars);
	} else { 
		$title = elgg_echo('voting:edit', array($voting->title));
		if ($voting->canEdit()) {
			$vars = voting_prepare_form_vars($voting);
			$content = elgg_view_form('voting/edit', array(), $vars);
		} else {
			$content = elgg_echo("voting:noaccess");
		}
	}
	
	
	$body = elgg_view_layout('content', array(
		'filter' => '',
		'content' => $content,
		'title' => $title,
	));
	
	echo elgg_view_page($title, $body);
}
