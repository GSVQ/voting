<?php
/**
 * Elgg voting plugin friends page
 *
 * @package voting
 */

$page_owner = elgg_get_page_owner_entity();
if (!$page_owner) {
	forward('', '404');
}

elgg_push_breadcrumb($page_owner->name, "voting/owner/$page_owner->username");
elgg_push_breadcrumb(elgg_echo('friends'));

elgg_register_title_button();

$title = elgg_echo('voting:friends');

$content = list_user_friends_objects($page_owner->guid, 'voting', 10, false);
if (!$content) {
	$content = elgg_echo('voting:none');
}

$params = array(
	'filter_context' => 'friends',
	'content' => $content,
	'title' => $title,
);

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
