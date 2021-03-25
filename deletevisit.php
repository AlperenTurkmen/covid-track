<?php  
               require_once "config.php";
                $id=$_REQUEST["id"];
                if (!empty($id)) {
                    $stmt = $conn->prepare('DELETE  FROM visits WHERE id = ? ;' );
                    $stmt->bind_param('i', $id); 
                    $stmt->execute();
                    $result = $stmt->get_result();
                   
               }
?>