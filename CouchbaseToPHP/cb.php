<?php
	date_default_timezone_set('UTC');
	$guid = guid();
	echo $guid;
	echo "<br><br>========== INSTANTIATE CLUSTER ============<br><br>";
	if(!extension_loaded('couchbase')) 
	{
		echo "class couchbase not found!! <br>";
	}
	
	$cluster = new CouchbaseCluster('127.0.0.1');
	
	if ($cluster)
		echo "CouchbaseCluster connection is successful. <br>";
	else
		echo "CouchbaseCluster connection is null. <br>";
	
	echo "<br><br>========== INSTANTIATE CLUSTER ============<br><br>";
	
	$db = $cluster->openBucket('default');
	
	if ($db)
		echo "Bucket is default. <br>";
	else
		echo "not create Bucket <br>";
	
	$db->upsert($guid, array('name'=>'Frank'));
	$res = $db->get($guid);
	var_dump($res->value);	
	
	echo "<br><br>========== UPDATING DOCUMENTS ============<br><br>";

	$res = $db->replace($guid, array('name'=>'Benson','abv'=>date('l \t\h\e jS')));
	var_dump($res);
	
	echo "<br><br>========== RETRIEVING DOCUMENTS ============<br><br>";
	
	$res = $db->get($guid);
	$doc = $res->value;
	echo $doc->name . ', ABV: ' . $doc->abv . "\n";
	
	
	
	function guid(){
		if (function_exists('com_create_guid')){
			return com_create_guid();
		}else{
			mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45);// "-"
			$uuid = chr(0)// "{"
					.substr($charid, 0, 8).$hyphen
					.substr($charid, 8, 4).$hyphen
					.substr($charid,12, 4).$hyphen
					.substr($charid,16, 4).$hyphen
					.substr($charid,20,12)
					.chr(0);// "}"
			return $uuid;
		}
	}
	
 ?>