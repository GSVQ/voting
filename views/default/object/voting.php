<?php
/**
 * View for voting object
 *
 * @package voting
 *
 * @uses $vars['entity']    The voting object
 * @uses $vars['full_view'] Whether to display the full view
 * 
 */

elgg_load_library('skeletor:voting');
$full = elgg_extract('full_view', $vars, FALSE);
$voting = elgg_extract('entity', $vars, FALSE);

if (!$voting) {
	return TRUE;
}

// voting used to use Public for write access
if ($voting->write_access_id == ACCESS_PUBLIC) {
	// this works because this metadata is public
	$voting->write_access_id = ACCESS_LOGGED_IN;
}


$annotation = $voting->getAnnotations(array('voting', 1, 0, 'desc'));
if ($annotation) {
	$annotation = $annotation[0];
}


$voting_icon = elgg_view('voting/icon', array('entity_guid' => $voting->guid, 'size' => 'small'));

$editor = get_entity($annotation->owner_guid);
$editor_link = elgg_view('output/url', array(
	'href' => "voting/owner/$editor->username",
	'text' => $editor->name,
	'is_trusted' => true,
));

$date = elgg_view_friendly_time($annotation->time_created);
$editor_text = elgg_echo('voting:strapline', array($date, $editor_link));
$categories = elgg_view('output/categories', $vars);

$comments_count = $voting->countComments();
//only display if there are commments
if ($comments_count != 0 && !$revision) {
	$text = elgg_echo("comments") . " ($comments_count)";
	$comments_link = elgg_view('output/url', array(
		'href' => $voting->getURL() . '#voting-comments',
		'text' => $text,
		'is_trusted' => true,
	));
} else {
	$comments_link = '';
}

$subtitle = "$editor_text $comments_link $categories";


// do not show the metadata and controls in widget view
if (!elgg_in_context('widgets')) {
	// Regular entity menu
	$metadata = elgg_view_menu('entity', array(
		'entity' => $vars['entity'],
		'handler' => 'voting',
		'sort_by' => 'priority',
		'class' => 'elgg-menu-hz',
	));
}


if ($full) {	
	
	if (voting_control_view_fields($voting)) {
		$views_options_fields = voting_prepare_fields($voting);
		$subtitle .= elgg_view('voting/fields', array(
			'entity' => $voting,
			'views_options' => $views_options_fields
		));
	}
		
	if (voting_control_view_description($voting)) {
		$views_options_description = voting_prepare_description($voting);
		$body .= elgg_view('voting/description', array(
			'entity' => $voting,
			'views_options' => $views_options_description
		));
	}	 	
	
	if (voting_control_view_open_close_button($voting)) {
		$views_options_open_close_button = voting_prepare_open_close_button($voting);
		$body .= elgg_view('voting/open_close_button', array(
			'views_options' => $views_options_open_close_button
		));
	}
		
	$vote_vals = voting_prepare_vote_form_vars($voting);
	if (voting_control_view_vote_options($voting)) {		
		$body .= elgg_view_form('voting/vote', array(), $vote_vals); 
	} else {
		$body .= elgg_view('voting/options', $vote_vals); 
	}
	
	if (voting_control_show_or_not_results($voting)) {
		$body .= elgg_view('voting/results', $vote_vals);
		if ($voting->auditory == 'on') {
			$body .= elgg_view('voting/auditory', array('entity' => $voting));
		}
	}
	
	$params = array(
		'entity' => $voting,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
	);
	$params = $params + $vars;
	$summary = elgg_view('object/elements/summary', $params);

	echo elgg_view('object/elements/full', array(
		'entity' => $voting,
		'title' => false,
		'icon' => $voting_icon,
		'summary' => $summary,
		'body' => $body,
	));

} else {
	// brief view

	$excerpt = elgg_get_excerpt($voting->description);

	$params = array(
		'entity' => $voting,
		'metadata' => $metadata,
		'subtitle' => $subtitle,
		'content' => $excerpt,
	);
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block($voting_icon, $list_body);
}
