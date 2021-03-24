<?php

//[{"x":220,"y":200,"date":"2021-03-23","time":"11:30:00","duration":20}]


$url = 'http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/report.php?';
echo '<br>url:',$url;

//$data = array('x' => '9999', 'y' => '9999' , 'date'=>'2021-03-23' , 'time'=>'19:59:59' , 'duration' => 20);
$data = array("x" => "2020", "y" => "2021" , "date"=>"2021-03-24" , "time"=>"11:11:22"    , "duration"=>999);
$data = array( "x"=>"3138","y"=>"1267","date"=>"2021-03-24","time"=>"10:00:00","duration"=>"15");     
echo '<br>data:',json_encode($data);
$options = array(
        'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    )
);
echo '<br>options:',json_encode($options);

$context  = stream_context_create($options);
echo '<br>contect:',$context;
$result = file_get_contents( $url, false, $context );
echo '<br>result:',$result;
$response = json_decode( $result );
echo '<br>respomse:',$response;
?>