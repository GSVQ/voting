<?php



elgg_load_js('chartjs');
elgg_load_library('skeletor:voting');


$voting = elgg_extract('entity', $vars, null);
$options = elgg_extract('options', $vars);
$n_options = elgg_extract('n_options', $vars);
$user_guid = elgg_get_logged_in_user_guid();
$voted_option = voting_user_option_voted($voting->guid, $user_guid);
$voting_guid = $voting->guid;
$colores = colores_por_matiz_HSL(0 , 64, 60 , $n_options);

$count = array();
$total = 0;
foreach ($options as $option_field_n => $option) {
	$votes = elgg_get_annotations(array(
		'annotation_name' => 'votes',
		'guid' => $voting_guid,
		'annotation_value' => $option_field_n,
		 
	));
	$count[$option] = count($votes);
	$total = $total + count($votes);
}
echo '<center><h2>';
echo elgg_echo('voting:results' , array($voting->title));
echo '</h2></center>';


//echo '</ul>';
	echo '<div class="container-voting">
				<div class="voting-result-chart">
					<center>
						<div id="canvas-holder">
							<canvas id="chart-area" width="300px" height="300px"></canvas>
						</div>
					</center>				
				</div>				
				
					
		</div>';
	



$b=0;

foreach ($count as $option => $votes) {
	$option_result[$option] = $votes;
	$option_color[$option] = $colores[$b];
	$b++;
}
arsort($option_result);
echo '<div class="voting-result-options">';		
echo '<ul class="pie-legend">';
foreach ($option_result as $option => $votes) {
	$color = $option_color[$option];
	$percent = round(($votes/$total)*100, 2);
	
	echo "<br/><li><span  class=\"back-color-voting-option\" style=\"background-color:$color \"></span>";
	echo "<span class=\"option-legend-title\"> $option </span>" ;
	echo "<p>";
	echo elgg_echo('voting:legend:votes');
	echo " $votes <br>";
	echo  elgg_echo('voting:legend:total:votes');
	echo " $total <br>";
	echo  elgg_echo('voting:legend:percent');
	echo " $percent" . '%';
	echo "</p></li>";
	
}
echo '</ul>';
echo '</div>';
?>
<script>
	var total = <?php echo $total; ?>;
	
	var pieData = [
		<?php foreach ($count as $option => $votes) { ?>			
			{	value: <?php echo $votes; ?> ,
				label: "<?php echo $option; ?>" ,
				color: "<?php echo $option_color[$option]; ?>",
							
			},
		<?php
		} ?>	
		];		
	var options = {
		//Boolean - Whether we should show a stroke on each segment
		segmentShowStroke : true,		
		//String - The colour of each segment stroke
		segmentStrokeColor : "#fff",		
		//Number - The width of each segment stroke
		segmentStrokeWidth : 2,		
		//Number - The percentage of the chart that we cut out of the middle
		percentageInnerCutout : 0, // This is 0 for Pie charts		
		//Number - Amount of animation steps
		animationSteps : 50,		
		animationEasing : "easeInQuart",		
		//Boolean - Whether we animate the rotation of the Doughnut
		animateRotate : true,		
		//Boolean - Whether we animate scaling the Doughnut from the centre
		animateScale : false,		
		//String - A legend template
		tooltipTemplate: "<%var labelb = label.substr( 0, label.lastIndexOf( ' ', 20 ) ) + '...';%><%= labelb %> : <%= Math.round((value / total)*10000)/100 %> % ",
		tooltipFillColor: "#F8F8F8",
		
		tooltipCornerRadius: 3,
		tooltipFontColor: "black",
		//legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><br/><li><span  class=\"back-color-voting-option\" style=\"background-color:<%=segments[i].fillColor%>\"></span><span class=\"option-legend-title\"><%if(segments[i].label){%><%=segments[i].label%><%}%></span><p><?php echo elgg_echo('voting:legend:votes'); ?> <%=segments[i].value%><br/> <?php echo elgg_echo('voting:legend:total:votes'); ?> <%=total %><br/> <?php echo elgg_echo('voting:legend:percent'); ?> <%= Math.round((segments[i].value / total)*10000)/100 %>% </p></li><%}%></ul>"
		
	}		
	window.onload = function(){
		var ctx = document.getElementById("chart-area").getContext("2d");
		window.myPieChart = new Chart(ctx).Pie(pieData,options);
		
		//var legendHolder = document.getElementById("chart-legend");
		//legendHolder.innerHTML = window.myPieChart.generateLegend();			
	};
	
// Otras Configuraciones 
//responsive: true,
//scaleStartValue: 0.4,		
//String - Animation easing effect

//valid animation easing effect are:
//easeInQuad
//easeOutQuad
//easeInOutQuad
//easeInCubic
//easeOutCubic
//easeInOutCubic
//easeInQuart
//easeOutQuart
//easeInOutQuart
//easeInQuint
//easeOutQuint
//easeInOutQuint
//easeInSine
//easeOutSine
//easeInOutSine
//easeInExpo
//easeOutExpo
//easeInOutExpo
//easeInCirc
//easeOutCirc
//easeInOutCirc
//easeInElastic
//easeOutElastic
//easeInOutElastic
//easeInBack
//easeOutBack
//easeInOutBack
//easeInBounce
//easeOutBounce
//easeInOutBounce
</script>





			










