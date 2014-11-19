<?php
/**
 * voting/pages/voting/all.php
 * 
 * List all voting
 *
 * @package voting
 */

$title = elgg_echo('voting:all');

elgg_pop_breadcrumb();
elgg_push_breadcrumb(elgg_echo('voting'));

elgg_register_title_button();

$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'voting',
	'full_view' => false,
));


if (!$content) {
	$content = '<p>' . elgg_echo('voting:none') . '</p>';
}

$body = elgg_view_layout('content', array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('voting/sidebar'),
));

echo elgg_view_page($title, $body);
