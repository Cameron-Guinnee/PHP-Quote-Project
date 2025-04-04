<?php 
$result = $cat->read();
$rowCount = $result->rowCount();

if ($rowCount == 0) 
{
    echo json_encode(
        array('message' => 'No categories found.')
    );
} 
else 
{
    $categories_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        extract($row);

        $category_item = array(
            'id' => $id,
            'category'=> $category
        );
        array_push($categories_arr, $category_item);
    }
    echo json_encode($categories_arr);
}
