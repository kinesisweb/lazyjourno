<?php 
	include_once('logic/truthiness.php');
	$pagePred = truthiness_setVariables();
?>
<div class="section-of-truth row no-gutters">
	<div class="col-12"><h3 class="text-center">The Moment of Truth</h3></div>
		<div class="col-12 justify-content-center d-inline-flex mt-3 mb-3">
		<div class="led-box">
    		<div class="led-<? echo $pagePred->status['colour'] ?>"></div>
  		</div>
  		<h5 class="ml-1 prediction-label">Prediction: <span class="prediction-<? echo $pagePred->status['status']; ?>"><? echo ucfirst($pagePred->status['status']); ?></span></h5>
  	</div>
  	<h5 class="line-text"><span>Past Form</span></h5>
	<div class="col-md-6 text-center p-0">
		<div class="row"><div class="col-12"><h5 class="text-center prediction-label">Journalist: <?php echo $pagePred->journalist; ?></h5></div></div>
		<input type="hidden" id="journalist-truthiness" value="<?php echo $pagePred->journo_score ?>">
		<canvas id="journalist-truthiness-gauge" class="truthiness-gauge" title="<?php echo $pagePred->journo_text; ?>"></canvas>
	</div>
	<div class="col-md-6 text-center p-0">
		<div class="row"><div class="col-12"><h5 class="text-center prediction-label">Publication: <?php echo $pagePred->publication; ?></h5></div></div>
		<input type="hidden" id="publication-truthiness" value="<?php echo $pagePred->pub_score ?>">
		<canvas id="publication-truthiness-gauge" class="truthiness-gauge" title="<?php echo $pagePred->pub_text; ?>"></canvas>
	</div>
</div>