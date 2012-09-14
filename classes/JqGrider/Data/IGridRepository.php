<?php
/**
* JqGrider library
*
* @package    nMind\jqGrider
* @version    1.0.0
* @license    MIT License
* @copyright  2012 Ivan Đurđevac
*/

namespace JqGrider\Data;
use Conditions;

interface IGridRepository
{
	/**
	 * 
	 * Get data for grid
	 * @param Conditions $dataConditions
	 */
	public function getData(Conditions $dataConditions);
	
	/**
	 * 
	 * Get number of all rows
	 * @param Conditions $dataConditions
	 */
	public function countDataRows(Conditions $dataConditions);
}