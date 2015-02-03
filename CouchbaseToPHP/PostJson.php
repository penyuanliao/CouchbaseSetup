<?php
	//檢查是不是POST
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		header("responseURL: text1111");
		//送出去的header為json
		header('Content-Type: application/json; charset=utf-8');
		//接收post Content-Type:json; 
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		
		$cluster = new CouchbaseCluster("127.0.0.1");
		
		$db = $cluster->openBucket("default");
		
		$loadavgstats = sys_getloadavg();
		
		$res = $db->insert($obj->key, array('id'=>$obj->id,'data'=>$obj->data,'cpu'=>$loadavgstats,'ram'=>getServerMemoryUsage()));
		
		$res = $db->get($obj->key);
		
		$doc = $res->value;

		// $posts[] = array("foo" => "bar","uname" => "oop!", "postValue"=> $obj[0]->uname);
		
		 echo json_encode($doc);
	}

function getServerMemoryUsage(){

    $free = shell_exec('free');
    $free = (string)trim($free);
    $free_arr = explode("\n", $free);
    $mem = explode(" ", $free_arr[1]);
    $mem = array_filter($mem);
    $mem = array_merge($mem);
    $memory_usage = $mem[2]/$mem[1]*100;

    return $memory_usage;
}
?>