<?php
	// POST RETURN
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		header('Content-Type: application/json; charset=utf-8');
		$posts[] = array("foo" => "bar","uname" => "oop!");
		 echo json_encode($posts);
	}
	
	$data = (array) $_POST;
	$cluster = new CouchbaseCluster(constant("127.0.0.1"));
	
	$this->db = $cluster->openBucket("default");
	$loadavgstats = sys_getloadavg();
	$res = $db->insert($data["key"], array('id'=>$data["id"],'data'=>$data["data"],'cpu'=>$loadavgstats,'ram'=>getServerMemoryUsage()));
	
	$res = $db->get($data["key"]);
	$doc = $res->value;
	
	echo json_encode($doc);
	
?>