<?php
try
{
    //Set the response content type to application/json
    header("Content-Type:application/json");
    $resp = '{"ResultCode":0,"ResultDesc":"Confirmation recieved successfully"}';
    //read incoming request
    $postData = file_get_contents('php://input');
    //log file
    $filePath = "\opt\appLogs\messages.log";
    //error log
    $errorLog = "\opt\appLogs\errors.log";
    //Parse payload to json
    $jdata = json_decode($postData,true);
    //perform business operations on $jdata here
    //open text file for logging messages by appending
    $file = fopen($filePath,"a");
    //log incoming request
    fwrite($file, $postData);
    fwrite($file,"\r\n");
    //log response and close file
    fwrite($file,$resp);
    fclose($file);
} catch (Exception $ex){
    //append exception to errorLog
    $logErr = fopen($errorLog,"a");
    fwrite($logErr, $ex->getMessage());
    fwrite($logErr,"\r\n");
    fclose($logErr);
}
    //echo response
    echo $resp;
?>
