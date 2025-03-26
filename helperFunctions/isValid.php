<?php 
//      This is mean to ensure that the user-provided id exists in the database.
//  In essence, it sets the model to the value of the id provded and then reads that id from the database. 
//  It'll return true if the id is found; if the id isn't found, it will return false.
function isValid($id, $model)
{ 
    $model->id = $id; 
    $model->read_single(); 
    $className = get_class($model);
    
    if ($className == "Category" || $className == "Author") 
    {
        return $model->name; 
    } 
    else if ($className == "Quote")
    {
        return ($model->theQuote);
    }
}
