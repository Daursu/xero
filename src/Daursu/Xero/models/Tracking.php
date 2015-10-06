<?php namespace Daursu\Xero\Models;

class Tracking extends BaseModel {

	/**
	 * The name of the primary column.
	 *
	 * @var string
	 */
	protected $primary_column = 'TrackingID';

	/**
	 * The name of the entity
	 *
	 * @var string
	 */
	protected static $entity = 'Tracking';

	/**
	 * The singular name of the entity
	 *
	 * @var string
	 */
	protected static $entity_singular = 'TrackingCategory';

}