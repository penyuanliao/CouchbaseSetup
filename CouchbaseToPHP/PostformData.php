<?php
	// POST RETURN
	if ($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		header('Content-Type: application/json; charset=utf-8');
		
		$docName = $_POST["key"];
		$id = $_POST["id"];
		$data = $_POST["data"];
		
		$cluster = new CouchbaseCluster("127.0.0.1");
		
		$db = $cluster->openBucket("default");
		
		$loadavgstats = sys_getloadavg();
		
		$res = $db->insert($docName, array('id'=>$id,'data'=>$data,'cpu'=>$loadavgstats,'ram'=>getServerMemoryUsage()));
		
		$res = $db->get($docName);
		
		$doc = $res->value;
		
		echo json_encode($doc);
	}
	
function getServerMemoryUsage()
{

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