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

class Ajax extends Data_Type_Grid_Abstract
{
	/**
	 * (non-PHPdoc)
	 * @see JqGrider.Data_Type_Grid_Abstract::addDetailsToOptions()
	 */
	public function addDetailsToOptions($options, $grid)
	{
		$options['url'] 		= $grid->dataUrl;
		$options['pager'] 		= $grid->pagerDivIdentifier;
		$options['rowList'] 	= $grid->rowList;
		$options['sortname'] 	= $grid->sortName;
		$options['viewrecords'] = $grid->viewRecords;
		$options['rowNum'] 		= $grid->rowsPerPage;
		$options['sortorder'] 	= $grid->sortOrder;
	
		return $options;
	}
}