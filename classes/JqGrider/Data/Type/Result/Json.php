<?php
/**
* JqGrider library
*
* @package    nMind\jqGrider
* @version    1.0.0
* @license    MIT License
* @copyright  2012 Ivan Đurđevac
*/

namespace JqGrider\Data\Type\Result;

class Json implements IResultType
{
	/**
	 * (non-PHPdoc)
	 * @see JqGrider\Data\Type.IResultType::conversResource()
	 */
	public function printData($resultResource)
	{
		print json_encode($resultResource);
	}
}