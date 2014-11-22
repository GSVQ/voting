<?php
/*




///////////


.voting-result {
	min-width: 300px;
}






*/
?>

.back-color-voting-option {
    border-radius: 5px;
    display: inline-block;
    height: 20px;
    left: 0;
    margin-right: 10px;
    top: 0;
    width: 20px;
}

#chart-area {
	max-width: 100%;
		
}

.voting-result-chart {
	margin-top: 20px;
	margin-bottom: 20px;
}

.option-voting-list {
	
}

.pie-legend li {
    border-bottom: 1px solid #dcdcdc;    
    padding: 10px;
}


.option-legend-title {
   
    font-size: large;
   
}
.voting-options-fields > li {
  border: 1px solid #dcdcdc;
  margin: 10px;
  padding: 10px;
    
}
.pie-legend {
    border-top: 1px solid #dcdcdc;
}


.elgg-button.elgg-button-green {
    background: none repeat scroll 0 0 teal;
}


.not-access-voting {
    background-color: mistyrose;
    padding: 10px;
}

.elgg-form.elgg-form-voting-vote {
    clear: both;
}


.voting-subtitle > li {
    float: left;
    font-size-adjust: 0.65;
    font-style: initial;
    min-width: 335px;
    padding-top: 5px;
   
}

.voting-options-sortable {
	
	/*background-image: url(<?php echo elgg_get_site_url() . "mod/voting/images/mover.png" ; ?>);*/
	background-position: 10px;
	background-repeat: no-repeat;
	margin: 10px;
	
	cursor: move;
		
}

.voting-options-sortable:hover {
	/*background-image: url(<?php echo elgg_get_site_url() . "mod/voting/images/mover2.png" ; ?>);*/
	color: #4690D6;	
}

.move-icon-span {
	width: 40px;
	height: 20px;
	background-image: url(<?php echo elgg_get_site_url() . "mod/voting/images/mover.png" ; ?>);
	background-position: 10px;
	background-repeat: no-repeat;
	margin-right: 20px;
	display: inline-block;
}

.move-icon-span:hover {
	background-image: url(<?php echo elgg_get_site_url() . "mod/voting/images/mover2.png" ; ?>);
}
