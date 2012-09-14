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

class Conditions
{
	/**
	 * Rows per page
	 * @var int
	 */
	protected $rowsLimit;
	
	/**
	 * Current page
	 * @var int
	 */
	protected $page;
	
	/**
	 * Sort asc or desc
	 * @var string
	 */
	protected $sort;

	/**
	 * Sort by coll
	 * @var string
	 */
	protected $sortBy;

	/**
	 * Is search request
	 * @var bool
	 */
	protected $search;
	
	/**
	 * Search field
	 * @var string
	 */
	protected $searchField;
	
	/**
	 * Search criteria
	 * @var string
	 */
	protected $searchString;
	
	/**
	 * Search operator
	 * @var string
	 */
	protected $searchOperator;
	
	/**
	 * Where clausule part, you can use it in your models
	 * @var string
	 */
	protected $searchCondition;

	/**
	 * Initialize conditions
	 */
	public function initConditions()
	{
		$this->rowsLimit 	= (int)$_GET['rows'];
		$this->page			= (int)$_GET['page'];
		$this->sort			= $_GET['sord'];
		$this->sortBy		= $_GET['sidx'];
		$this->search		= $_GET['_search'];

		if ($this->search === 'true')
		{
			$this->searchField 		= $_GET['searchField'];
			$this->searchString 	= $_GET['searchString'];
			$this->searchOperator 	= $_GET['searchOper'];
				
			$this->createCondition();
		}
	}
	
	/**
	 * Access to all protected fields
	 * @param string $item
	 */
	public function __get($item)
	{
		return isset($this->{$item}) ? $this->{$item} : null;
	}
	
	/**
	 * Create search conditions based on search criteria
	 */
	private function createCondition()
	{
		if ($this->searchOperator)
		{
			switch ($this->searchOperator)
			{
				case 'eq' : // Equal
					{
						$this->searchCondition = "`$this->searchField` = :grid_search_string";
						break;
					}
				case 'ne' : // Not equal
					{
						$this->searchCondition = "`$this->searchField` != :grid_search_string";
						break;
					}
				case 'bw' : // Begin with
					{
						$this->searchString = $this->searchString.'%';
						$this->searchCondition = "`$this->searchField` LIKE :grid_search_string";
						break;
					}
				case 'bn' : // Does not begin with
					{
						$this->searchString = $this->searchString.'%';
						$this->searchCondition = "`$this->searchField` NOT LIKE :grid_search_string";
						break;
					}
				case 'ew' : // Ends with
					{
						$this->searchString = '%'.$this->searchString;
						$this->searchCondition = "`$this->searchField` LIKE :grid_search_string";
						break;
					}
				case 'en' : // Does not ends with
					{
						$this->searchString = '%'.$this->searchString;
						$this->searchCondition = "`$this->searchField` NOT LIKE :grid_search_string";
						break;
					}
				case 'cn' : // Contain
					{
						$this->searchString = '%'.$this->searchString.'%';
						$this->searchCondition = "`$this->searchField` LIKE :grid_search_string";
						break;
					}
				case 'nc' : // Does not contain
					{
						$this->searchString = '%'.$this->searchString.'%';
						$this->searchCondition = "`$this->searchField` NOT LIKE :grid_search_string";
						break;
					}
				case 'nu' : // Is null
					{
						$this->searchCondition = "`$this->searchField` IS NULL ";
						break;
					}
				case 'nn' : // Not null
					{
						$this->searchCondition = "`$this->searchField` IS NOT NULL";
						break;
					}
				case 'in' : // In
					{
						//$this->searchString = explode(',', $this->searchString);
						//$this->searchString = "'".str_replace(',', "','", $this->searchString)."'";
						$this->searchCondition = "`$this->searchField` IN ( :grid_search_string )";
						break;
					}
				case 'ni' : // Not in
					{
						$this->searchString = "'".str_replace(',', "','", $this->searchString)."'";
						$this->searchCondition = "`$this->searchField` NOT IN (:grid_search_string)";
						break;
					}					
			}
		}

		return false;
	}
}