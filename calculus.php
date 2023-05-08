<?php

function readJSONFile($filePath) {
    $jsonData = file_get_contents($filePath);
    return json_decode($jsonData, true);
}

function writeJSONFile($filePath, $data) {
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filePath, $jsonData);
}


function calculateExpression($expression) {
    try {
        $expression = preg_replace("#[^0-9+\-*/().]#", "", $expression);
        eval('$result = '.$expression.';');
        $response = [
            'error' => false,
            'result' => $result
        ];

        $data = array(
            'expression' => $expression,
            'result' => $result
        );
        $filePath = 'history.json';
        $jsonData = json_encode($data);
        $existingData = readJSONFile($filePath);
       // file_put_contents($filePath, $jsonData);

        $existingData[] = $data;     
        $existingData = array_slice($existingData, -5);
        writeJSONFile($filePath, $existingData);


    } catch (Exception $e) {
        $response = [
            'error' => true,
            'message' => 'Failed to calculate the expression: ' . $e->getMessage()
        ];
    }
    $jsonResponse = json_encode($response);
    return $jsonResponse;
}

if(isset($_GET['action']) && $_GET['action']=="history"){
    $filePath = 'history.json';
    $readJson = readJSONFile($filePath);
    $jsonread = json_encode($readJson);
    echo $jsonread;
}else{

if (isset($_GET['query']) && $_GET['query'] != "") {
    $expression = base64_decode($_GET['query']);
    $jsonResult = calculateExpression($expression);
    header('Content-Type: application/json');
    echo $jsonResult;
} else {
    $errorResponse = [
        'error' => true,
        'message' => 'Failed to convert the expression to a result.'
    ];
    $errorResponse = json_encode($errorResponse);
    header('Content-Type: application/json');
    echo $errorResponse;
}
}
?>