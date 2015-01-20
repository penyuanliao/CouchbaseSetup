<?php
	if(!extension_loaded('couchbase')) 
	{
		echo "class couchbase not found!! \n";
	}
	$cluster = new CouchbaseCluster('127.0.0.1');
	if ($cluster)
		echo "create CouchbaseCluster is successful. \n";
	else
		echo "create CouchbaseCluster is null. \n"
 ?>