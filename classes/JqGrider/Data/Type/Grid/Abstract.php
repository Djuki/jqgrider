<?php
/**
* JqGrider library
*
* @package    nMind\jqGrider
* @version    1.0.0
* @license    MIT License
* @copyright  2012 Ivan Đurđevac
*/

namespace JqGrider;

abstract class Data_Type_Grid_Abstract
{
	/**
	 * 
	 * Add more details to the grid json options
	 * @param array $options
	 * 
	 * @return array
	 */
	public function addDetailsToOptions($options, $grid)
	{
		return $options;
	}
	
	
	/**
	 * 
	 * Add more Javascript after Grid is initialized
	 * 
	 * @return string
	 */
	public function getAditionalJavaScript()
	{
		return false;
	}
}