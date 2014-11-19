<?php
/**
 * View a voting
 *
 * @package voting
 */

$voting = get_entity(get_input('guid'));
if (!$voting) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

$page_owner = elgg_get_page_owner_entity();

$crumbs_title = $page_owner->name;

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb($crumbs_title, "voting/group/$page_owner->guid/all");
} else {
	elgg_push_breadcrumb($crumbs_title, "voting/owner/$page_owner->username");
}

$title = $voting->title;

elgg_push_breadcrumb($title);

$content = elgg_view_entity($voting, array('full_view' => true));
$content .= elgg_view_comments($voting);

$body = elgg_view_layout('content', array(
	'content' => $content,
	'title' => $title,
	'filter' => '',
));

echo elgg_view_page($title, $body);
