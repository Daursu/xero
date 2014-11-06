<?php

use Daursu\Xero\Contact;
use Daursu\Xero\Address;
use Daursu\Xero\Collection;

class ContactsTest extends TestCase {

	public function testCreateContact()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$contact = new Contact();

		$contact->Name = "John Smith";
		$contact->EmailAddress = "user@example.com";
		$contact->FirstName = "John";
		$contact->LastName = "Smith";
		$contact->DefaultCurrency = "GBP";
		$contact->save();

		/*
		|------------------------------------------------------------
		| Expectation
		|------------------------------------------------------------
		*/
		// print_r($contact->toArray());
		// print_r($contact->toXML());

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue(is_string($contact->ContactID));
	}

	public function testFindContact()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$contact = Contact::find("3f73432a-2b95-4ae7-b5d6-79808e74c254");

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue($contact->ContactID == "3f73432a-2b95-4ae7-b5d6-79808e74c254");
	}

	public function testFindByContact()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$contacts = Contact::findBy(array("Where" => 'Name.Contains("John Smith")'));

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue($contacts instanceof Collection);
	}

}