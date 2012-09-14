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

class Xml implements IResultType
{
	/**
	 * (non-PHPdoc)
	 * @see JqGrider\Data\Type.IResultType::conversResource()
	 */
	public function printData($resultResource)
	{
		$xml = new \SimpleXMLElement('<rows/>');
		$xml->addChild('page', $resultResource->page);
		$xml->addChild('total', $resultResource->total);
		$xml->addChild('records', $resultResource->records);

		if (isset($resultResource->rows) and ! empty($resultResource->rows))
		{
			foreach ($resultResource->rows as $key => $row)
			{
				foreach ($row as $key => $innerRow)
				{
					if ($key == 'cell')
					{
						foreach ($innerRow as $collRow)
						{
							$xmlRow->addChild('cell', $collRow);
						}
					}
					else
					{
						$xmlRow = $xml->addChild('row');
						$xmlRow->addAttribute($key, $innerRow);
					}
				}
			}
		}

		header ("Content-Type:text/xml");
		print $xml->asXML();

	}
}