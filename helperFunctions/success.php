<?php 
// This'll echo a JSON message stating that [OPERATION] was completed.
function success($modelType, $op) 
{
    echo json_encode(
        array("message" => $modelType . " " . $op)
    );
}
