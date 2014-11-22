<?php
/**
 * voting helper functions
 *
 * @package voting
 */

/**
 * Prepare the add/edit form variables
 *
 * @param ElggObject $voting A voting object.
 * @return array
 */
function voting_prepare_form_vars($voting = null) {
	// input names => defaults
	$values = array(
		'title' => '', 
		'description' => '',
		'information_link' => 'http://',		
		'tags' => '',
		'voting_type' => 'notmal',
		'access_id' => ACCESS_DEFAULT,
		'vote_access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'guid' => null,
		'entity' => $voting,
		'num_choices' => 1,
		'auditory' => 'on',
		'show_live_result' => 'on',
		'start_date' => '',
		'end_date' => '', 
	);

	if ($voting) {
		foreach (array_keys($values) as $field) {
			if (isset($voting->$field)) {
				$values[$field] = $voting->$field;
			}
		}
	}

	if (elgg_is_sticky_form('voting')) {
		$sticky_values = elgg_get_sticky_values('voting');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('voting');

	return $values;
}

/**
 * Prepare the voting/vote form variables
 *
 * @param ElggObject $voting A voting object.
 * @return array
 */

function voting_prepare_vote_form_vars($voting = null) {
	$n_options = $voting->options_n;
	if ($voting->num_choices) {
		$num_choices = $voting->num_choices;
	} else {
		$num_choices = 1;
	}
	for ($i=0; $i<$n_options; $i++) {
		$op_field = 'options_field_' . $i;
		$options[$op_field] = $voting->$op_field;
		
	}
	
	$values = array(
		'entity' => $voting,
		'options' => $options,
		'n_options' => $n_options,
		'num_choices' => $num_choices,		
	
	);
	
	return $values;
	
}

function voting_user_option_voted($voting_guid = null, $user_guid = null) {
	$option = '';
	// Do stuff
	return $option;
	
}

function colores_por_matiz_HSL($h , $s, $l, $step) {
	$paso = floor(360 / ($step));
	$colors = array();
	for ($i=0; $i < $step; $i++) {		
		
		$hsl = $h +  $i*$paso . ',' . $s  . '%,' . $l . '%)';
		$colors[] = 'hsl('. $hsl;	
		
	}
	return $colors;
}

function monocromatico_HSL($h, $s, $l, $step) {
	$paso = floor(80 / ($step));
	for ($i=0; $i < $step; $i++) {
		$arraycolor = fGetRGB($h, $s, 100 -(20 + $i*$paso));
		$colors[] = "rgb($arraycolor[0], $arraycolor[1], $arraycolor[2])";
	}
	return $colors;
}

function fGetRGB($iH, $iS, $iV) {
 
if($iH < 0) $iH = 0; // Hue:
if($iH > 360) $iH = 360; // 0-360
if($iS < 0) $iS = 0; // Saturation:
if($iS > 100) $iS = 100; // 0-100
if($iV < 0) $iV = 0; // Lightness:
if($iV > 100) $iV = 100; // 0-100
 
$dS = $iS/100.0; // Saturation: 0.0-1.0
$dV = $iV/100.0; // Lightness: 0.0-1.0
$dC = $dV*$dS; // Chroma: 0.0-1.0
$dH = $iH/60.0; // H-Prime: 0.0-6.0
$dT = $dH; // Temp variable
 
while($dT >= 2.0) $dT -= 2.0; // php modulus does not work with float
$dX = $dC*(1-abs($dT-1)); // as used in the Wikipedia link
 
switch($dH) {
case($dH >= 0.0 && $dH < 1.0):
$dR = $dC; $dG = $dX; $dB = 0.0; break;
case($dH >= 1.0 && $dH < 2.0):
$dR = $dX; $dG = $dC; $dB = 0.0; break;
case($dH >= 2.0 && $dH < 3.0):
$dR = 0.0; $dG = $dC; $dB = $dX; break;
case($dH >= 3.0 && $dH < 4.0):
$dR = 0.0; $dG = $dX; $dB = $dC; break;
case($dH >= 4.0 && $dH < 5.0):
$dR = $dX; $dG = 0.0; $dB = $dC; break;
case($dH >= 5.0 && $dH < 6.0):
$dR = $dC; $dG = 0.0; $dB = $dX; break;
default:
$dR = 0.0; $dG = 0.0; $dB = 0.0; break;
}
 
$dM = $dV - $dC;
$dR += $dM; $dG += $dM; $dB += $dM;
$dR *= 255; $dG *= 255; $dB *= 255;
 
return array(round($dR), round($dG), round($dB));
}

function hexcolorFromArraycolor($arraycolor) {
  return '#'
     .substr('0'.dechex($arraycolor[0]),-2)
     .substr('0'.dechex($arraycolor[1]),-2)
     .substr('0'.dechex($arraycolor[2]),-2)
  ;
}

function familia_de_colores_rbg($result_number = 10, $arrayHSL = array(array(105, 55, 0))) {
	$num_color_inicio = count($arrayHSL);
	//print_r($arrayHSL);
	$num_de_cada =  floor($result_number / $num_color_inicio);
	$resto = $result_number % $num_color_inicio;
	foreach ($arrayHSL as $HSL) {
		if ($resto == 0) {
			$result[] = monocromatico_HSL($HSL[0], $HSL[1], $HSL[2], $num_de_cada);
		} else {
			$result[] = monocromatico_HSL($HSL[0], $HSL[1], $HSL[2], $num_de_cada + 1);
			$resto = $resto -1 ;
		}
	}
	$pas = count($result[0]);
	for ($i=0; $i < $pas; $i++) {
		for ($j = 0; $j < $num_color_inicio; $j++) {
			$return[] = $result[$j][$i];
		}
	}
	return $return; 
	
}

function shuffle_assoc($list) { 
  if (!is_array($list)) return $list; 

  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) { 
    $random[$key] = $list[$key]; 
  }
  return $random; 
}

function voting_is_open($voting) {
	$start_date = $voting->start_date;
	$start_date_ts = strtotime($start_date);
	$end_date = $voting->end_date;
	$end_date_ts = strtotime($end_date);
	
	
	$now_ts = time();
	$closed = $voting->closed;
	if (!$end_date_ts) {
		$before_end_or_undetermined = true;
	} else if ($now_ts <= $end_date_ts) {
		$before_end_or_undetermined = true;
	} else {
		$before_end_or_undetermined = false;
	}
	
	if ($before_end_or_undetermined && $now_ts >= $start_date_ts && !$closed) {
		return true;
	}else {
		return false;
	}
	
}
function voting_is_ended($voting) {
	$closed = $voting->closed;
	$end_date = $voting->end_date;
	$end_date_ts = strtotime($end_date);
	$now_ts = time();
	if ($closed) {
		return true;
	} else if  ($end_date && $end_date_ts < $now_ts) {
		return true;
	} else {
		return false;
	}
}

function voting_is_not_started_or_no_votes($voting) {
	$start_date = $voting->start_date;
	$start_date_ts = strtotime($start_date);
	$now_ts = time();
	$no_votes = true;
	if ($voting) {
		$votes = elgg_get_annotations(array(
				'guid' => $voting->guid,
				'annotation_name' => 'votes', 
				//'annotation_owner_guid' => $user_guid,
				'limit' => 0,
				));
		
	}
	if ($votes) {
		$no_votes = false;
	}
	
	if ($now_ts <= $start_date_ts or $no_votes) {
		return true;
	}else {
		return false;
	}
	
}

function voting_user_can_vote($voting) {
	if ($voting->getSubtype() == 'voting') {

		$vote_permission = $voting->vote_access_id;
		$user = elgg_get_logged_in_user_entity();

		if ($user) {
			switch ($vote_permission) {
				case ACCESS_PRIVATE:
					$owner = $voting->getOwnerEntity();
					if ($owner->guid == $user->guid || elgg_is_admin_logged_in()) {
						return true;
					} else {
					// Elgg's default decision is what we want
						return false;
					}
					break;
				case ACCESS_FRIENDS:
					$owner = $voting->getOwnerEntity();
					if ($owner && $owner->isFriendsWith($user->guid) || $owner->guid == $user->guid) {
						
						return true;
						
					}
					
					break;
				default:
					$list = get_access_array($user->guid);
					if (in_array($vote_permission, $list)) {
						// user in the access collection
						return true;
					}
					break;
			}
		}
	}
}

// Control views: Decide if show or not some views

function voting_control_view_fields($voting) {
	return true;
}

function voting_control_view_description($voting) {
	if($vote->description){
		return true;
	} else {
		return false;
	}
}

function voting_control_view_open_close_button($voting) {
	$user_guid = elgg_get_logged_in_user_guid();
	if (($user_guid == $voting->owner_guid || elgg_is_admin_logged_in()) && !$voting->end_date) {
		return true;
	} else {
		return false;
	}
}

function voting_control_view_vote_options($voting) {
	if (voting_is_open($voting) && voting_user_can_vote($voting)) {
		return true;
	} else {
		return false;
	}	
}

function voting_control_show_or_not_results($voting){
	if (!voting_is_not_started_or_no_votes($voting) && ($voting->show_live_result == 'on' || voting_is_ended($voting))) {
		return true;
	} else {
		return false;
	}
}
		



// prepare views: get data for views
function voting_prepare_fields($voting) {
	$display_fields = array(	
		'information_link' => 'url',
		'voting_type' => 'text',
		'num_choices' => 'text',
		'auditory' => 'text',
		'show_live_result' => 'text',
		'start_date' => 'date',
		'end_date' => 'date',
		);
	return $display_fields;
	
}

function voting_prepare_description($voting) {
	$return['description'] = $voting->description;
	return $return;
}

function voting_prepare_open_close_button($voting) {
	if ($voting->closed) {
		$return['action_url'] = 'action/voting/open?guid=' . $voting->getGUID();
		$return['text'] = elgg_echo('voting:open');
		$return['confirm'] = elgg_echo('voting:openwarning');
		$return['class'] = 'elgg-button elgg-button-green float-alt';
					
	}else {
		$return['action_url'] = 'action/voting/close?guid=' . $voting->getGUID();
		$return['text'] = elgg_echo('voting:close');
		$return['confirm'] = elgg_echo('voting:closewarning');
		$return['class'] = 'elgg-button elgg-button-delete float-alt';			 	
		
	}
	return $return;
}


	



















