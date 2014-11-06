<?php namespace Daursu\Xero;

interface AccountsBaseModelInterface {

	public static function get($params = array());
	public static function find($id);
	public function create($params = array());
	public function update($params = array());
	public function save($params = array());
	public function delete();

}