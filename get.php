<?php
try{
   
    $url = 'http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/ctracker/infections.php?ts=1'.$ip;
  
    $response =file_get_contents($url);
    $data = json_decode($response, true);

    foreach ($data AS $d){
        echo $d['x'];
        echo '</br>';
    }

      
    
    echo '</br>';
    echo '</br>';
    if ($response !== false){
        echo json_encode($response);
    }

    
}
catch(Exception $e){
    echo $e->getMessage();
}

?>

