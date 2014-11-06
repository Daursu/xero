<?php namespace Daursu\Xero;

use SimpleXMLElement;

class Collection extends \Illuminate\Support\Collection {

	/**
	 * The name of the entity
	 *
	 * @var string
	 */
	protected $entity;

	/**
	 * The singular name of the entity
	 *
	 * @var string
	 */
	protected $entity_singular;

	/**
	 * Constructor function
	 *
	 * @param string $type
	 * @param array  $items
	 */
	public function __construct($type, $singular = '', $items = array())
	{
		$this->entity = $type;
		$this->entity_singular = $singular ? : str_singular($type);
		$this->setItems($items);
	}

	/**
	 * Set all the items at once
	 *
	 * @param array $items
	 */
	public function setItems($items = array())
	{
		$this->items = array();

		foreach ($items as $key => $item) {
			if ( ! is_numeric($key) && is_array($item)) {

				// Check to see if the item contains many subitems
				if (array_key_exists('1', $item)) {
					$this->setItems($item);
					return false;
				}
				else {
					// This is a single item
					$this->push($item);
				}

			}
			elseif (is_array($item)) {
				$this->push($item);
			}
		}
	}

	/**
	 * Add a new item to the collection
	 *
	 * @param  mixed $item
	 * @return void
	 */
	public function push($item)
	{
		$full_class_name = $this->getFullClassName();

		if (is_array($item)) {
			array_push($this->items, new $full_class_name($item));
		}
		elseif ($item instanceof $full_class_name) {
			array_push($this->items, $item);
		}
	}

	/**
	 * Return the entity name
	 *
	 * @return string
	 */
	public function getEntityName()
	{
		return $this->entity;
	}

	/**
	 * Retrieves the class of the objects in this collection
	 * including the namespace
	 *
	 * @return string
	 */
	public function getFullClassName()
	{
		return __NAMESPACE__ . '\\' . $this->entity_singular;
	}

	/**
	 * Return the singular form of the class name
	 *
	 * @return string
	 */
	public function getSingularEntityName()
	{
		$full_class_name = $this->getFullClassName();
		$temp = new $full_class_name;

		return $temp->getSingularEntityName();
	}

	/**
	 * Convert the model to an array
	 *
	 * @return array
	 */
	public function toArray()
	{
		$output = array();

		foreach ($this->items as $key => $value) {
			array_push($output, $value->toArray(true));
		}

		return array(
			$this->getEntityName() => array(
					$this->getSingularEntityName() => $output
				),
		);
	}

	/**
	 * Converts the model to XML
	 *
	 * @return string
	 */
	public function toXML($singular = false)
	{
		$output = new SimpleXMLElement(
			sprintf("<%s></%s>", $this->getEntityName(), $this->getEntityName())
		);

		BaseModel::array_to_xml($this->toArray(), $output);

		return $output->asXML();
	}

}