<?php
/**
* JqGrider library
*
* @package    nMind\jqGrider
* @version    1.0.0
* @license    MIT License
* @copyright  2012 Ivan Đurđevac
*/

namespace JqGrider\Data\Type\Grid;

use JqGrider\Data_Type_Grid_Abstract;

class Local extends Data_Type_Grid_Abstract
{
	/**
	*
	* Data for grid
	* @var array
	*/
	protected $localData = array();
	
	/**
	 *
	 * Set local data for grid
	 * @param array $data
	 */
	public function setLocalData(array $data)
	{
		$this->localData = $data;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see JqGrider.Grid::getAditionalJavaScript()
	 */
	public function getAditionalJavaScript()
	{
		$js = '';
		$i = 1;
		foreach ($this->localData as $localDataRow)
		{
			$jsonData = json_encode($localDataRow);
			$js .= <<<JS
					jQuery("#list2").jqGrid('addRowData',$i,$jsonData);
JS;
			++$i;
		}
	
		return $js;
	}
}