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

interface IResultType
{
	/**
	 * 
	 * Convert resource to Class data type
	 * And print on screen
	 * 
	 * @param stdClass $resultResource
	 */
	public function printData($resultResource);
}