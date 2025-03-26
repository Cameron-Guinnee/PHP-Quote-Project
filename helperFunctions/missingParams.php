<?php 
// This'll echo a JSON message stating that the required parameters are missing.
function missingParams() 
{
    echo json_encode(
        array('message' => 'Missing Required Parameters')
    );
}
?>
