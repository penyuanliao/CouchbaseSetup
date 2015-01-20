<?php
	//檢查是不是POST
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		//送出去的header為json
		header('Content-Type: application/json; charset=utf-8');
		//接收post Content-Type:json; 
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		
		$cluster = new CouchbaseCluster(constant("127.0.0.1"));
		

		$posts[] = array("foo" => "bar","uname" => "oop!", "postValue"=> $obj[0]->uname);
		
		 echo json_encode($posts);
	}
	
	// $data = (array) $_POST;
	// $cluster = new CouchbaseCluster(constant("127.0.0.1"));
	
	// $this->db = $cluster->openBucket("default");
	// $loadavgstats = sys_getloadavg();
	// $res = $db->insert($data["key"], array('id'=>$data["id"],'data'=>$data["data"],'cpu'=>$loadavgstats,'ram'=>getServerMemoryUsage()));
	
	// $res = $db->get($data["key"]);
	// $doc = $res->value;
	
	// echo json_encode($doc);
	
?>