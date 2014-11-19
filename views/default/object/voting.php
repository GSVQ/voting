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
	$body .= '<b>' . elgg_echo('voting:description') . '</b><br/>';
	$body .= elgg_view('output/longtext', array('value' => $voting->description)) . '<br/>';
	$display_fields = array(	
		'information_link' => 'url',
		'num_choices' => 'text',
		'auditory' => 'text',
		'show_live_result' => 'text',
		'start_date' => 'date',
		'end_date' => 'date',
		);
	
	foreach ($display_fields as $name => $type) {
		if ($name == 'end_date' && !$voting->end_date) {
			$body .= '<b>' . elgg_echo("voting:label:$name") . ': </b>';
			$body .= elgg_view("output/$type", array('value' => elgg_echo('voting:manual:control'))) . '<br>';	
		} else {
			$body .= '<b>' . elgg_echo("voting:label:$name") . ': </b>';
			$body .= elgg_view("output/$type", array('value' => $voting->$name)) . '<br>';	
		}	
	}
	
	$user_guid = elgg_get_logged_in_user_guid();
	if (($user_guid == $voting->owner_guid || elgg_is_admin_logged_in()) && !$voting->end_date) {
		if ($voting->closed) {
			$open_url = 'action/voting/open?guid=' . $voting->getGUID();
			$body .= elgg_view('output/confirmlink', array(
				'text' => elgg_echo('voting:open'),
				'href' => $open_url,
				'confirm' => elgg_echo('voting:openwarning'),
				'class' => 'elgg-button elgg-button-green float-alt',
			));
			
		}else { 	
			$close_url = 'action/voting/close?guid=' . $voting->getGUID();
			$body .= elgg_view('output/confirmlink', array(
				'text' => elgg_echo('voting:close'),
				'href' => $close_url,
				'confirm' => elgg_echo('voting:closewarning'),
				'class' => 'elgg-button elgg-button-delete float-alt',
			));
		}
	}
	
	
		
	$vote_vals = voting_prepare_vote_form_vars($voting);
	$vote_access_id = $voting->vote_access_id;
	$access_colection = get_access_array($user_guid);
	
	//print_r($access_colection);
	//print_r($vote_access_id);
	//print_r($members);
	if (voting_is_open($voting) && voting_user_can_vote($voting)) {
		$body .= elgg_view_form('voting/vote', array(), $vote_vals); 
	} else {
		$body .= elgg_view('voting/options', $vote_vals); 
	}
	$votes = elgg_get_annotations(array(
				'guid' => $voting->guid,
				'annotation_name' => 'votes', 
				//'annotation_owner_guid' => $user_guid,
				'limit' => 0,
				));
	//print_r($votes);
	$variables = elgg_get_config('voting');
	
	/* 
	 * Para imprimir todo lo guardado DEBUG
	foreach ($variables as $name => $type) {
		$body .= "$name" . ':' . $voting->$name . '<br>';
		
	}
	*/ 
	if (voting_is_not_started_or_no_votes($voting)) {
		
	} else {
	
		$body .= elgg_view('voting/results', $vote_vals);	
		
		if ($voting->auditory == 'on') {
			$body .= '<br><h3>' . elgg_echo('auditory:auditory') . '</h3>';
			$body .= elgg_list_annotations(array(
				'guid' => $voting->guid,
				'annotation_name' => 'votes', 
				//'annotation_owner_guid' => $user_guid,
				'limit' => 10,
				));
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
