<?php 
if (!property_exists($data, 'category')) 
{
    missingParams();
} 
else 
{
    $cat->name = $data->category;
    if ($cat->create()) 
    {
        $results = array(
            'id' => $cat->id,
            'category' => $cat->name
        ); 
        echo json_encode($results);
        //echo json_encode(
        //    array(
        //        'id' => $cat->id,
        //        'category' => $cat->name
        //    )
        //);
    } 
    else 
    {
        fail("Category", "Created");
    }
}
//exit();
