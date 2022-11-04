<?php
class connect
{
	var $db=null;
	public function __construct() 
	{
		$dsn='mysql:host=181.215.242.74;dbname=giayshop;port=18854';
		$user='admin';
		$pass='WAqArjVr';
		$this->db=new PDO($dsn,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	}
	//	Lấy nhiều rows
	public function getList($select)
	{
		$results=$this->db->query($select);
		// echo $results;
		return($results);
	}

	public function exec($query)
	{
		$results=$this->db->exec($query);
		// echo $results;
		return($results);
	}
	public function getInstance($query) 
	{
		$results=$this->db->query($query);
		// echo $select;
		$result=$results->fetch();
		return $result;
	}
}
?>