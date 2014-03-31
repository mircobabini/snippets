<?
/**
 * testing comodity
 * @package Type
 *
 * Copyright (C) 2011 mirkolofio.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *
 * The author of this software is mirkolofio.
 * For any question or feedback please
 *		contact me at: mirkolofio(at)gmail(dot)com
 *		or surf my website: http://mirkolofio.net/
 */

/**
 * @param mixed $var
 * @param String $message
 * @return bool
 */
function ts ($var, $message = "")
{
	return Type::checkGeneric ($var, Type::TYPE_STRING, $message);
}
/**
 * @param mixed $var
 * @param String $message
 * @return bool
 */
function ti ($var, $message = "")
{
	return Type::checkGeneric ($var, Type::TYPE_INT, $message);
}
/**
 * @param mixed $var
 * @param String $message
 * @return bool
 */
function tf ($var, $message = "")
{
	return Type::checkGeneric ($var, Type::TYPE_FLOAT, $message);
}
/**
 * @param mixed $var
 * @param String $message
 * @return bool
 */
function tfi ($var, $message = "")
{
	$eMessage = "FLOAT OR INT";
	$eMessage .= ($message) ? ", " . $message : "";
	return Type::checkGenerics ($var, array (Type::TYPE_FLOAT, Type::TYPE_INT), $eMessage);
}

/**
 * @param mixed $var
 * @param String $message
 * @return bool
 */
function ta ($var, $message = "")
{
	return Type::checkGeneric ($var, Type::TYPE_ARRAY, $message);
}

function tgen ($var)
{
	$args = func_get_args ();
	array_pop ($args);

	if (sizeof ($args) == 0)
		return new Exception ("called tgen without any check type");

	return Type::checkGenerics ($var, $args);
}
