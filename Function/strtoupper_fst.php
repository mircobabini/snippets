<?
/**
 * Returns the original string with first letter uppercased
 *
 * @param String $string
 * @return String
 */
function strtoupper_fst ($string)
{
	return strtoupper (substr ($string, 0, 1)) . substr ($string, 1);
}
