<?php 
// This'll echo a JSON message stating that the id wasn't found.
function notFound($modelType) 
{
    echo json_encode(
        array('message' => $modelType . '_id Not Found')
    );
}
