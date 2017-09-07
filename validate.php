<?php
try
{
    //Set the response content type to application/json
    header("Content-Type:application/json");
    $resp = '{"ResultCode":0,"ResultDesc":"Validation passed successfully"}';
    //read incoming request
    $postData = file_get_contents('php://input');
    $filePath = "\opt\appLogs\messages.log";
    //error log
    $errorLog = "\opt\appLogs\errors.log";
    //Parse payload to json
    $jdata = json_decode($postData,true);
    //perform business operations here
    //open text file for logging messages by appending
    $file = fopen($filePath,"a");
    //log incoming request
    fwrite($file, $postData);
    fwrite($file,"\r\n");
} catch (Exception $ex){
    //append exception to file
    $logErr = fopen($errorLog,"a");
    fwrite($logErr, $ex->getMessage());
    fwrite($logErr,"\r\n");
    fclose($logErr);
    //set failure response
    $resp = '{"ResultCode": 1, "ResultDesc":"Validation failure due to internal service error"}';
}
    //log response and close file
    fwrite($file,$resp);
    fclose($file);
    //echo response
    echo $resp;
?>
