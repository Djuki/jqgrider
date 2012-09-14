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
use JqGrider\Data\Type\Factory;

class RepositoryResult
{

	/**
	 *
	 * Data
	 * @var array
	 */
	protected $rows;

	/**
	 *
	 * Count all records
	 * @var int
	 */
	protected $records;

	/**
	 *
	 * Current page
	 * @var int
	 */
	protected $page;

	/**
	 *
	 * Total pages
	 * @var int
	 */
	protected $total;

	public static function printData(\JqGrider\Grid $grid)
	{

		$repository = $grid->getRespository();

		$conditions = new Conditions();
		$conditions->initConditions();

		// Call implementator to convert resource into setup data type
		$implementator = Factory::createResultImplementator($grid->getDataType());

		$implementator->printData(self::createResource($repository, $conditions, $grid));
	}

	/**
	 *
	 * Create resource for json data answer
	 * @param Data\IGridRepository $repository
	 * @param Conditions $conditions
	 * @param Grid $grid
	 *
	 * @return stdClass
	 */
	private static function createResource($repository, $conditions, $grid)
	{
		$resource = new \stdClass();
		if ($repositoryData = $repository->getData($conditions))
		{
			$resource->rows 	= self::adaptRepositoryData($repositoryData, $grid->getSortName(), $grid->getColumnCollection());
		}
		$resource->records 	= (string)$repository->countDataRows($conditions);
		$resource->page 	= (string)$conditions->page;


		//Total pages
		$resource->total = ($resource->records > 0) ? ceil($resource->records/$conditions->rowsLimit) : 0;

		return $resource;
	}

	/**
	 *
	 * Adapt result data from respository to easy convert into json
	 * @param array $repositoryData
	 * @param string $sortField
	 * @param ColumnCollection $columnCollection
	 *
	 * @return array
	 */
	private static function adaptRepositoryData($repositoryData, $sortField = 'id', $columnCollection)
	{
		$jsonFriendly = array();

		foreach ($repositoryData as $repositoryRow)
		{
			$jsonFriendlyRow = array();
			$jsonFriendlyColl = array();

			if (is_array($repositoryRow))
			{
				$jsonFriendlyRow[$sortField] = $repositoryRow[$sortField];
			}
			elseif (is_object($repositoryRow))
			{
				$jsonFriendlyRow[$sortField] = $repositoryRow->{$sortField};
			}

			foreach ($columnCollection as $column)
			{
				if ($callback = $column->getCallbackFunction())
				{
					if (is_array($repositoryRow))
					{
						$jsonFriendlyColl[] = $callback($repositoryRow[$column->getRepositoryAttribute()]);
					}
					elseif (is_object($repositoryRow))
					{
						$jsonFriendlyColl[] = $callback($repositoryRow->{$column->getRepositoryAttribute()});
					}
				}
				else
				{
					if (is_array($repositoryRow))
					{
						$jsonFriendlyColl[] = $repositoryRow[$column->getRepositoryAttribute()];
					}
					elseif (is_object($repositoryRow))
					{
						$jsonFriendlyColl[] = $repositoryRow->{$column->getRepositoryAttribute()};
					}
				}
			}
			
			$jsonFriendlyRow['cell'] = $jsonFriendlyColl;
			$jsonFriendly[] = $jsonFriendlyRow;

		}

		return $jsonFriendly;
	}


}