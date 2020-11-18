<?php

/*
First you need to store the path of file that you want to read and convert
*/

if (file_exists('R:/input.txt')) {

    $file = file_get_contents('R:/input.txt', FILE_USE_INCLUDE_PATH);

    $xmlData = "<?xml version='1.0'?> $file";

	// Load XML file into an object
    $xml = simplexml_load_string($xmlData) or die("Error: gagal membuat object xml");


    // start listing all content form xml variable
    $jsonArray = [];
    foreach($xml->span as $span){
        $spanArr = ((array)$span);

        // get content of 'char' attributes inside xml file or string
        $char = "";
        foreach($spanArr['char'] as $charObj) {
            $charArr = ((array)$charObj);
            $char = $char.$charArr['@attributes']['c'];
        }

        // outputing into array
        $jsonArray[] = [
            'bbox' => $spanArr['@attributes']['bbox'],
            'size' => $spanArr['@attributes']['size'],
            'font' => $spanArr['@attributes']['font'],
            'char' => $char
        ];
    }

    // list all array
    var_dump($jsonArray);

	/*
	Now translate it to an JSON string and 
	assign the JSON string to $json
	*/
    // $json = json_encode($xml, JSON_PRETTY_PRINT);
 
	// Output JSON
    // print_r($json);
}
else {
    exit('Unable to open File');
}

?>