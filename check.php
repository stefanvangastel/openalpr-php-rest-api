<?php
//Shorten
define('DS',DIRECTORY_SEPARATOR);

/**
 * Set default vars
 */
$response['message']= '';
$response['data'] 	= array();

/**
 * Check tmp dir and write permissions
 */
if( ! file_exists('tmp') ){

	if( ! mkdir('tmp') ){
		//Try to create
		$response['error']= 'Error: Cannot create tmp dir in current dir, please check webserver permissions.';
		respond($response);
	}	
}

/**
 * Check exec and ALPR command
 */
if( ! function_exists("exec")){
	$response['error']= 'Error: php exec not available, safe mode?';
	respond($response);
}

if( empty(run('alpr --version')) ){
	$response['error']= 'Error: alpr command not found, is it installed and in your PATH?';
	respond($response);
}

/**
 * Check POSTED data.
 */
if( empty($_POST['image']) ){
	$response['error']= 'Error: No image data recieved. Please send a base64 encoded image';
	respond($response);
}

/**
 * Save image to disk (tmp)
 */
if( ! file_put_contents('tmp'.DS.'check.jpg', base64_decode($_POST['image']) ) ){
	$response['error']= 'Error: Failed saving image to disk, please check webserver permissions.';
	respond($response);
}

/**
 * Run ALPR command on image
 */
$result = run('alpr --country eu --json tmp'.DS.'check.jpg');

/**
 * Remove image
 */
unlink('tmp'.DS.'check.jpg');

/**
 * Check result.
 */
if( empty( $result[0] ) ){
	$response['error']= 'Error: ALPR returned no result';
	respond($response);
}

//Add results to response
$response['data'] = json_decode( $result[0], TRUE);

//Respond with results
respond($response);

/**
 * Aux functions
 */

//Sets headers and responds json
function respond($response){
	header('Access-Control-Allow-Origin: *');
	header('Cache-Control: no-cache, must-revalidate');
	header('Content-type: application/json');

	echo json_encode($response);
	exit;
}

//Runs command and returns output
function run($command){
	$output = array();
	exec($command,$output);
	return $output;
}
?>