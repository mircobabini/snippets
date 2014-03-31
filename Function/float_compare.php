<?
/**
 * @param float $left_op
 * @param float $right_op
 * @param int $scale
 * @return int 
 * 
 * @author _lamemind
 */
function float_compare ($left_op, $right_op, $scale)
{
	$left_op = round ($left_op, $scale);
	$right_op = round ($right_op, $scale);

	return $left_op > $right_op ? 1 :
			($left_op < $right_op ? -1 : 0);
}