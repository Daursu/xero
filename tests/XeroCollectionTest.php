<?php

use Daursu\Xero\Models\Contact;
use Daursu\Xero\Models\Address;
use Daursu\Xero\Models\Collection;

class XeroCollectionTest extends PHPUnit_Framework_TestCase {

	public function testCollection()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$collection = Contact::newCollection();

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue($collection instanceof Collection);
		$this->assertTrue(count($collection) == 0);
	}

	public function testCollectionItems()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$collection = Address::newCollection();

		// Pushing an address as an array
		$collection->push(array('AddressType' => 'STREET', 'AddressLine1' => 'Street', 'AddressLine2' => 'England'));

		// Testing pushing an address as an object
		$address = new Address(array('AddressType' => 'OBJECT', 'AddressLine1' => 'Oxford', 'AddressLine2' => 'England'));

		$collection->push($address);

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue(count($collection) == 2);

		// Each item in the collection should be of type BaseModel
		foreach ($collection as $key => $item) {
			$this->assertTrue($item instanceof Address);
		}
	}

	public function testCollectionItemsInitialization()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$collection = Address::newCollection(array(
			array('AddressType' => 'NEW', 'AddressLine1' => 'Cambridge', 'AddressLine2' => 'England'),
			array('AddressType' => 'OTHER', 'AddressLine1' => 'London', 'AddressLine2' => 'England'),
			// Throw in an object as well
			// new Address(array('AddressType' => 'OBJECT', 'AddressLine1' => 'Oxford', 'AddressLine2' => 'England')),
		));

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue(count($collection) == 2);
	}

	public function testCollectionToArray()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$collection = Address::newCollection(array(
			array('AddressType' => 'NEW', 'AddressLine1' => 'Cambridge', 'AddressLine2' => 'England'),
			array('AddressType' => 'OTHER', 'AddressLine1' => 'London', 'AddressLine2' => 'England'),
		));

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue(is_array($collection->toArray()));
	}
}