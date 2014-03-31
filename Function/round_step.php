<?
/**
 * rounds a float to the nearest on step-scale
 * 
 * @param float $value	value to round
 * @param float $step	step-scale,
 * @return float		rounded value
 * 
 * @package Handframe/Tool/Function
 * @author Mirco Babini <mirkolofio@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc/3.0/
 */
function round_step ($value, $step = 1)
{
	$mul = 1 / $step;
	if ($mul >= 1) $mul = round ($mul);

	return (int)((round ($value * $mul)) / $mul);
}

// examples:
// round_step (2.5, 1);		=> 3
// round_step (2.5, 0.5);	=> 2.5
// round_step (2.6, 0.5);	=> 2.5
// round_step (2.5, 0.3);	=> 2.6666666666667
// round_step (2.45, 0.2);	=> 2.4
