<?php 
$data = $_GET;

if (isset($data['author_id'])) 
{
    $quo->author_id = $data['author_id'];

    if (isset($data['category_id'])) 
    {
        $quo->category_id = $data['category_id'];
        $result = $quo->read_author_and_category();
    }
    else 
    {
        $result = $quo->read_author();
    }
} 
else if (isset($data['category_id'])) 
{
    $quo->category_id = $data['category_id'];
    $result = $quo->read_category();
} 
else 
{
    $result = $quo->read();
}

$rowCount = $result->rowCount();

if ($rowCount == 0) 
{
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
} 
else 
{
    $quotes_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) 
    {
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category

        );
        array_push($quotes_arr, $quote_item);
    }
    echo json_encode($quotes_arr);
}
