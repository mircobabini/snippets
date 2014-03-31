<?
/**
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
class TypeNullException extends Exception
{
	/**
	 * @param mixed $var
	 * @param String $reqType
	 * @param String $message
	 */
	public function __construct ($message = "")
	{
		$eMessage = "var not passed NOT_NULL check";
		$eMessage .= ($message) ? " (" . $message . ")" : "";

		parent::__construct ($eMessage);
	}
}