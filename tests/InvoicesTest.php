<?php

use Daursu\Xero\Models\Invoice;
use Daursu\Xero\Models\Address;
use Daursu\Xero\Models\Collection;

class XeroInvoicesTest extends PHPUnit_Framework_TestCase {

	public function testSetId()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$invoice = new Invoice;
		$invoice->setId("0263f2bd-5825-476b-b6cf-6b76896a8cff");

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue($invoice->getId() == "0263f2bd-5825-476b-b6cf-6b76896a8cff");
	}

	public function testGetPdf()
	{
		/*
		|------------------------------------------------------------
		| Set
		|------------------------------------------------------------
		*/
		$invoice = Invoice::find("0263f2bd-5825-476b-b6cf-6b76896a8cff");

		/*
		|------------------------------------------------------------
		| Assertion
		|------------------------------------------------------------
		*/
		$this->assertTrue(is_string($invoice->getPdf()));
	}

}