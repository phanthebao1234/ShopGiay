<?php
class connect
{
	var $db=null;
	public function __construct() 
	{
		$dsn='mysql:host=sql12.freesqldatabase.com;dbname=sql12534834';
		$user='sql12534834';
		$pass='Bgr2ZvQ5qS';
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