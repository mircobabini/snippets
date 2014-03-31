<?
/**
 * @param String $str1
 * @param String $str2
 * @return int
 */
function str_compare ($str1, $str2)
{
	$score = levenshtein (metaphone ($str1), metaphone ($str2));
	return 100 - $score;
}

/**
 * @param type $str1
 * @param type $str2
 * @return type 
 * 
 * @author http://stackoverflow.com/users/146400/cambiata
 * @link http://stackoverflow.com/questions/5351659/algorithms-for-string-similarities-better-than-levenshtein-and-similar-text
 * @link http://cambiatablog.wordpress.com/2011/03/25/algorithm-for-string-similarity-better-than-levenshtein-and-similar_text/
 */
function str_compare2 ($str1, $str2)
{
	$len1 = strlen($str1);
	$len2 = strlen($str2);

	$i = 0;
	$segmentcount = 0;
	$segmentsinfo = array();
	$segment = '';
	while ($i < $len1)
	{
		$char = substr ($str1, $i, 1);
		if (strpos ($str2, $char) !== FALSE)
		{
			$segment = $segment.$char;
			if (strpos ($str2, $segment) !== FALSE)
			{
				$segmentpos1 = $i - strlen ($segment) + 1;
				$segmentpos2 = strpos ($str2, $segment);
				$positiondiff = abs ($segmentpos1 - $segmentpos2);
				$posfactor = ($len1 - $positiondiff) / $len2;
				$lengthfactor = strlen ($segment) / $len1;
				$segmentsinfo[ $segmentcount ] = array (
					'segment' => $segment,
					'score' => ($posfactor * $lengthfactor)
				);
			}
			else
			{
				$segment = '';
				$i--;
				$segmentcount++;
			}
		}
		else
		{
			$segment = '';
			$segmentcount++;
		}

		$i++;
	}

	// PHP 5.3 lambda in array_map
	$totalscore = array_sum (array_map (function ($v) { return $v['score']; }, $segmentsinfo));
	return $totalscore;
}

