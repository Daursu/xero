<?php

use Daursu\Xero\Invoice;
use Daursu\Xero\Address;
use Daursu\Xero\Collection;

class XeroInvoicesTest extends TestCase {

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