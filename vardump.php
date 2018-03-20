<?php

$c = array(1, 2, array("a", "b", "c"), array("z","x","cc"));
$b="ana are mere";
// var_dump($a);


function retrieveObjId($object,$hashes,$oid) {
    if(!isset($hashes[spl_object_hash($object)])) {
        $hashes[spl_object_hash($object)] = $oid;
        $oid++;
    }

    return $hashes[spl_object_hash($object)];
}


$o = (object) [
	'prop1' => 'val1',
	'prop2' => 3
];

// $a['obj'] = $o;

// var_dump($o);
// echo "<br>";
function myVarDump($param){

	$hashes = array();
	$oid = 1;
	$type = gettype($param);

	switch ($type) {
		case 'boolean':
			if($param){
				echo "bool(true)" ;
			}else{
				echo "bool(false)";
			}
			break;
		case 'integer':
			echo "int(".$param.")";
			break;
		case 'double':
			echo "float(" . $param. ")";
			break;
		case 'string':
			echo "string(". strlen($param) . ") " . '"'. $param . '"';
			break;
		case 'array':
			echo "array(" . count($param)."){ "; 
			// array_walk_recursive($param, 'test_print') . "\n";
			printArr($param);
			echo "}";
			break;
		case 'object':
			echo "object(" . get_class($param) . ")#". retrieveObjId($param,$hashes,$oid) ."(" . count(get_object_vars($param)) . ")";
			myVarDump(get_object_vars($param))  ;
			break;
		default:
			# code...
			break;
	}
}


// function test_print($item, $key)
// {
//     // echo "[$key] =>  $item\n";
//     $type = gettype($item);
//     switch ($type) {
// 		case 'boolean':
// 			if($item){
//     			echo "[$key] =>  bool($item)\n\n";
// 			}else{
//     			echo "[$key] =>  bool($item)\n";
// 			}
// 			break;
// 		case 'integer':
//     		echo "[$key] =>  int($item)\n\n";
// 			break;
// 		case 'double':
//     		echo "[$key] =>  float($item)\n";
// 			break;
// 		case 'string':
// 			// echo "string(". strlen($item) . ") " . '"'. $item . '"';
//     		echo "[$key] =>  string( ". strlen($item) ." )\" $item \" \n\n";
// 			break;
// 		case 'array':
// 			// echo "array(" . count($item)."){ "; 

// 		default:
// 			# code...
// 			break;
// 	}
// }


function printArr($arr){
	foreach ($arr as $key => $v) { 
        if (is_array($v)) { 
        	echo "[$key] => array(" . count($v)."){ ";
            $arr[$key] = printArr($v); 
            echo "}";
        } else { 
            $type = gettype($v);
		    switch ($type) {
				case 'boolean':
					if($v){
		    			echo "[$key] =>  bool($v)";
					}else{
		    			echo "[$key] =>  bool($v)";
					}
					break;
				case 'integer':
		    		echo "[$key] =>  int($v)";
					break;
				case 'double':
		    		echo "[$key] =>  float($v)";
					break;
				case 'string':
		    		echo "[$key] =>  string( ". strlen($v) ." )\" $v \" ";
					break;
		       } 
    	} 

	}
	// echo "}";
} 

myVarDump($o);

?>