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
abstract class Type
{
	const TYPE_BOOL		= "BOOLEAN";

	const TYPE_INT		= "INTEGER";
	const TYPE_FLOAT	= "FLOAT";
	
	/**
	 * per implementare questo bisogna cambiare il metodo di check,
	 * fare check specifici a seconda del tipo eccetera eccetera
	 */
	// const TYPE_NUMERIC	= "NUMERIC";

	const TYPE_STRING	= "STRING";
	const TYPE_ARRAY	= "ARRAY";

	const TYPE_NULL		= "NULL";
	const TYPE_NOT_NULL	= "NOT_NULL";



	protected static function baseCheck ($var, $type)
	{
		if ($type === self::TYPE_NOT_NULL && $var === null)
			throw new TypeNullException ();

		return (self::getType ($var) === $type);
	}
	/**
	 * @param mixed $var
	 * @param String $type
	 * @return bool
	 */
	public static function checkGeneric ($var, $type, $message = "")
	{
		if (self::baseCheck ($var, $type))
			return true;

		throw new TypeException ($var, $type, $message);
	}
	/**
	 * @param mixed $var
	 * @param array $types
	 * @return bool
	 */
	public static function checkGenerics ($var, $types, $message = "")
	{
		foreach ($types as $type)
			if (self::baseCheck ($var, $type))
				return true;

//		$varType = self::getType ($var);
//
//		foreach ($types as $type)
//			if ($varType === $type)
//				return true;
//
		throw new TypeException ($var, $type, $message);
	}
	/**
	 * @param mixed $var
	 * @return String
	 */
	private static function getType ($var)
	{
		$varType = gettype ($var);
		$varType = strtoupper ($varType);

		return $varType;
	}

}

