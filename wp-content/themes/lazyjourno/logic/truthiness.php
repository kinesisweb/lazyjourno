<?php 
class Prediction {
    function Prediction() {
    	global $post;
        $this->publication = get_post_meta( $post->ID, 'publication', true );
        $this->journalist = get_post_meta( $post->ID, 'journalist', true );
        $this->journo_pred = tallyPredictions('journalist');
        $this->journo_score = calculateScore($this->journo_pred);
        $this->pub_pred = tallyPredictions('publication');
        $this->pub_score = calculateScore($this->pub_pred);
        $this->journo_text = $this->journalist . ": Predictions are " . round($this->journo_score) . "% Accurate";
        $this->pub_text = $this->publication . ": Predictions are " . round($this->pub_score) . "% Accurate";
        $this->status = setPredicitionStatus(get_the_category()); 
    }
}


	function setPredicitionStatus($cats) {
		foreach ($cats as $cat) {
			if ($cat->term_id == 17) {$colour = "blue"; $status = "pending";}
			else if ($cat->term_id == 18) {$colour = "green"; $status = "correct";}
			else if ($cat->term_id == 19) {$colour = "red"; $status = "wrong";}
			else if ($cat->term_id == 20) {$colour = "yellow"; $status = "inconclusive";}
		}
		if (!$colour && !$status) {$colour = "blue"; $status = "pending";}
		$statObj = array("colour"=>$colour, "status"=>$status);
		return $statObj;
	}

	function truthiness_setVariables() {
		$pagePred = new Prediction();
		if ($pagePred->journo_score > 100) {
			$pagePred->journo_score = 50;
			$pagePred->journo_text = "No data available for this journalist";
		}
		if ($pagePred->pub_score > 100) {
			$pagePred->pub_score = 50;
			$pagePred->pub_text = "No data available for this publication";
		}
		return $pagePred;
	}

	function calculateScore($arr) {
		if (count($arr) == 0) {return 50;}
		$pending = 0;
		$score = 0;
		$weightCount = 0;
		$weight1 = 3; $weight2 = 2; $weight3 = 1;

		for ($i = 0; $i < count($arr); $i++) {
			if ($arr[$i] == 18) {
				if ($i == 0) {$score += 100 * $weight1; $weightCount += $weight1;}
				else if ($i < 5) {$score += 100 * $weight2; $weightCount += $weight2;}
				else {$score += 100 * $weight3; $weightCount += $weight3;}
			}
			else if ($arr[$i] == 19) {
				if ($i == 0) {$score += 0 * $weight1; $weightCount += $weight1;}
				else if ($i < 5) {$score += 0 * $weight2; $weightCount += $weight2;}
				else {$score += 0 * $weight3; $weightCount += $weight3;}
			}
			else if ($arr[$i] == 20) {
				if ($i == 0) {$score += 50 * $weight1; $weightCount += $weight1;}
				else if ($i < 5) {$score += 50 * $weight2; $weightCount += $weight2;}
				else {$score += 50 * $weight3; $weightCount += $weight3;}
			}
		}

		$weighted = $score / $weightCount;
		$weighted = is_nan($weighted) ? 101 : $weighted;
		return $weighted;
	}

function tallyPredictions($item) {
	global $wpdb;
	global $post;
	$results = $wpdb->get_results( "
	    SELECT $wpdb->posts.*
	    FROM $wpdb->posts, $wpdb->postmeta, $wpdb->term_relationships
	    WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id
	    AND $wpdb->posts.ID = $wpdb->term_relationships.object_ID
	    AND $wpdb->postmeta.meta_key = '" . $item . "' 
	    AND $wpdb->postmeta.meta_value = '" . get_post_meta( $post->ID, $item, true ) . "'
	    AND $wpdb->term_relationships.term_taxonomy_id = '16'
	    AND $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'post'
	    AND $wpdb->posts.post_date < NOW()
	    ORDER BY $wpdb->posts.post_date DESC
	 ");
	$predictions = array();
	foreach ( $results as $result ) 
	{
		$cats = get_the_category($result->ID);

	  	for ($i = 0; $i < count($cats); $i++) {
	  		if ($cats[$i]->term_id > 16 && $cats[$i]->term_id <= 20) {
	  			array_push($predictions, $cats[$i]->term_id);
	  		}
	  	}
	}
	return $predictions;
}