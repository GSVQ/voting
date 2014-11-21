<?php

$options = $vars['views_options'];

echo elgg_view('output/confirmlink', array(
				'text' => $options['text'],
				'href' => $options['action_url'],
				'confirm' => $options['confirm'],
				'class' => $options['class'],
			));
