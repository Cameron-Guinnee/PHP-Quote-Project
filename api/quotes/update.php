<?php 
if (!property_exists($data, 'id') || !property_exists($data, 'quote') || !property_exists($data, 'author_id') || !property_exists($data, 'category_id')) 
{
    missingParams();
} 
else 
{
    $auth = new Author($db);
    $cat = new Category($db);
    
    if (!isValid($data->id, $quo)) 
    {
        echo json_encode(
            array(
                "message" => "No Quotes Found"
            )
        );
    } 
    else if (!isValid($data->author_id, $auth))  
    {
        notFound("author");
    } 
    else if (!isValid($data->category_id, $cat))  
    {
        notFound("category");
    } 
    else 
    {
        $quo->theQuote = $data->quote;
        $quo->author_id = $data->author_id;
        $quo->category_id = $data->category_id;
        
        if ($quo->update()) 
        {
            echo json_encode(
                array(
                    'id' => $quo->id,
                    'quote' => $quo->theQuote,
                    'author_id' => $quo->author_id,
                    'category_id' => $quo->category_id
                )
            );
        } 
        else 
        {
            fail("Quote", "Updated");
        }
    }
}
exit();
