<?php 
// This'll echo a JSON message stating [OPERATION] NOT completed.
function fail(string $modelType, string $op) 
{
    echo json_encode( 
        array('message' => $modelType . " NOT " . $op)
    );
}
?>
