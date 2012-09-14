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

class Column
{
	const ALIGN_LEFT = 'left';
	
	const ALIGN_RIGHT = 'right';
	
	const ALIGN_CENTER = 'center';
	
	
	/**
	 * 
	 * Title for frontend
	 * @var string
	 */
	protected $title;

	/**
	 * 
	 * Repository attribute name
	 * @var string
	 */
	protected $repositoryAttribute;
	
	/**
	 * 
	 * Column width
	 * @var int
	 */
	protected $width;
	
	/**
	 * 
	 * Column text alignment
	 * Align left is default
	 * @var string
	 */
	protected $align = self::ALIGN_LEFT;
	
	/**
	 * Callback function
	 * @var Anonymous function
	 */
	protected $callbackFunction;
	
	/**
	 * 
	 * Constructor
	 * 
	 * @param string $title
	 * @param string $repositoryAttribute
	 * @param int $width
	 * @param mixed $callbackFunction
	 */
	public function __construct($title, $repositoryAttribute, $width, $callbackFunction = false)
	{
		$this->title = $title;
		$this->repositoryAttribute = $repositoryAttribute;
		$this->width = $width;
		
		$this->callbackFunction = $callbackFunction;
	}
	
	/**
	 * Get anonymous function for callback
	 */
	public function getCallbackFunction()
	{
		return $this->callbackFunction;
	}
	
	/**
	 * Get column title
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * Get respository attribute
	 * In most cases db table column name
	 */
	public function getRepositoryAttribute()
	{
		return $this->repositoryAttribute;
	}
	
	/**
	 * Get column width
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
}