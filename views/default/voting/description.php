<?php
$desc = $vars['views_options']['description'];


echo '<b>' . elgg_echo('voting:description') . '</b><br/>';
echo elgg_view('output/longtext', array('value' => $desc)) . '<br/>';
