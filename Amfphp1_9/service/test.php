<?php

include_once("../cbConfig.php");
require_once(AMFPHP_BASE . 'amf/util/TraceHeader.php');
class test
{
	
	var $cluster;
	var $db;
	
	function __construct()
	{
		$cluster = $this->cluster;
		$cluster = new CouchbaseCluster(constant("COUCHBASE_HOST"));
		$this->db = $cluster->openBucket(constant("COUCHBASE_BUCKET"), constant("COUCHBASE_PWD"));
	}
	function info($json)
	{
		$data = (array) $json;
		return $data["description"];
	}
	/**
	* 測試 {'key':'testdoc','id':99}
	**/
	function getService($json)
	{
	
		$data = (array) $json;
		$cluster = $this->cluster;
		
		$db = $this->db;
		$loadavgstats = sys_getloadavg();
		// $res = $db->replace($data["key"], array('name'=>'Benson','abv'=>date('l \t\h\e jS'),'data'=>getString(),'cpu'=>(float)getServerCPUUsage(),'ram'=>getServerMemoryUsage()));
		$res = $db->insert($data["key"], array('id'=>$data["id"],'data'=>getString(),'cpu'=>$loadavgstats,'ram'=>getServerMemoryUsage()));
		
		$res = $db->get($data["key"]);
		$doc = $res->value;
		
		return $doc;
	}
	/**
	* 測試 {"key":"testdocs1","id":"99","name":"asdfsadf"}
	**/
	function insertService($json)
	{
	
		date_default_timezone_set('UTC');
		
		$data = (array) $json;
		$cluster = $this->cluster;
		
		$db = $this->db;
		$res = $db->insert($data["key"], array('name'=>'Benson','abv'=>date('l \t\h\e jS'),'id'=>(int)$data["id"]));
		
		$res = $db->get($data["key"]);
		$doc = $res->value;
		
		return $doc;
	}
	function getDocumentValue($document)
	{
		$cluster = $this->cluster;
		$db = $this->db;
		$res = $db->get($document);
		$doc = $res->value;
		return $doc;
	}
	function removeDocumentValue($document)
	{
		$cluster = $this->cluster;
		$db = $this->db;
		$res = $db->get($document);
		$doc = $res->value;
		return $doc;
	}
	//{"list":["demo1","demo2"]}
	function getBulkOperations($json)
	{
		$data = (array) $json;
		$cluster = $this->cluster;
		$db = $this->db;
		$res = $db->get((array)$data["list"]);
		$result = [];
		$i = 0;
		//拆解物件
		foreach ($res as &$type) 
		{
			$result[$data["list"][$i]] = $type->value;
			$i++;
		}
		return $result;
	}
	function queryingBuckets($str)
	{
		$cluster = $this->cluster;
		$db = $this->db;
		$query = CouchbaseViewQuery::from('sample', $str);
		$res = $db->query($query);
		$doc = $res->value;
		
		return $res;
	}
	function sysInfo()
	{
		$loadavgstats = substr(file_get_contents('/proc/loadavg'), 0, 14);
		return array("CPU"=>(float)getServerCPUUsage(),"RAM"=>getServerMemoryUsage(),"cpu2"=>$loadavgstats);
	}
	function sysPath($json)
	{
		$data = (array) $json;
		return $data["key"] ;
	}
	function form()
	{

		$arrayOut = new output();
		$arrayOut->grid = $this->gridValue();
		$arrayOut->week= $this->getAllWeek($this->ThisYear);
		return $arrayOut;
	}
	/****/
	function phpInfo()
	{
		$version = phpversion();
		$ext = new ReflectionExtension('couchbase');
		$json = new ReflectionExtension('json');
		
		$res = array("phpVersion" => $version, "couchbase" => $ext->getVersion(), "json" => $json->getVersion());
		
		return $res;
	}
}

function getServerCPUUsage()
{
	$load = sys_getloadavg();
	return (float)$load[0];
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
function getString()
{
	$str = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
aaaaaaaaaaaaaaaaaaaaaaaa";

	return $str;
}


?>