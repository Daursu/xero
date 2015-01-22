<?php namespace Daursu\Xero\Models;

class Invoice extends BaseModel {

	/**
	 * The name of the primary column.
	 *
	 * @var string
	 */
	protected $primary_column = 'InvoiceID';

	/**
	 * Retrieves a PDF file of an invoice
	 *
	 * @return mixed
	 */
	public function getPdf($id = '')
	{
		$id = $id ? : $this->attributes[$this->primary_column];
		return $this->request('GET', sprintf('%s/%s', $this->getUrl(), $id), array(), "", "pdf");
	}

}