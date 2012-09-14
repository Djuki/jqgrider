<?php
/**
* JqGrider library
*
* @package    nMind\jqGrider
* @version    1.0.0
* @license    MIT License
* @copyright  2012 Ivan Đurđevac
*/

namespace JqGrider\Data\Type;
use JqGrider\Data\Type\Result\IResultType;

use JqGrider\Grid_Exception;
use JqGrider\Data_Type_Grid_Abstract;

class Factory
{
	/**
	 * 
	 * Create implemetator for data type
	 * @param unknown_type $dataType
	 */
	public static function createResultImplementator($dataType)
	{
		$className = '\\JqGrider\\Data\\Type\\Result\\'.ucfirst($dataType);
		
		return self::createObject($className, '\JqGrider\Data\Type\Result\IResultType');
	}
	
	/**
	 * Create implementator for grid Type
	 * @param string $dataType
	 * @return unknown
	 */
	public static function createImplementator($dataType)
	{
		$gridType = $dataType == \JqGrider\Grid::DATA_TYPE_LOCAL ? 'Local' : 'Ajax';
		$className = '\\JqGrider\\Data\\Type\\Grid\\'.$gridType;
		
		return self::createObject($className, '\JqGrider\Data_Type_Grid_Abstract');
	}
	
	/**
	 * 
	 * Object creator
	 * @param string $className
	 * @param string $insatnceOf
	 * 
	 * @return mixed
	 */
	private static function createObject($className, $insatnceOf)
	{
		$implementator = new $className;
		
		if (is_subclass_of($implementator, $insatnceOf))
		{
			return $implementator;
		}
		
		throw new Grid_Exception('class '.$className.' is not implemented '.$insatnceOf.' interface');
	}
}