<?php
/**
* JqGrider library
*
* @package    nMind\jqGrider
* @version    1.0.0
* @license    MIT License
* @copyright  2012 Ivan Đurđevac
*/

namespace JqGrider\Grid;
use Iterator;

class ColumnCollection implements Iterator
{
	/**
	 * Current position
	 * @var int
	 */
	private $position = 0;
	
	/**
	 * Column array
	 * @var array
	 */
	private $array = array();
	
	/**
	 * Add column in collection
	 * @param Column $column
	 */
	public function add(Column $column)
	{
		$this->array[] = $column;
		return $this;
	}
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->position = 0;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::rewind()
	 */
	function rewind() {
		$this->position = 0;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::current()
	 */
	function current() {
		return $this->array[$this->position];
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::key()
	 */
	function key() {
		return $this->position;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::next()
	 */
	function next() {
		++$this->position;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Iterator::valid()
	 */
	function valid() {
		return isset($this->array[$this->position]);
	}
}

