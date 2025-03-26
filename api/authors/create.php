<?php 

if (!property_exists($data, "author")) 
{
    missingParams();
} 
else 
{
    $theAuthor->name = $data->author;
    if ($theAuthor->create()) 
    {
        //     The POST requests are getting HTML for the response, and I have no clue why. 
        //  I didn't do anything different with the return method here, but it is what it is. 
        //  I'm going to see if writing the code this way with trailing semicolons will fix the issue. 
        //  If it doesn't, then I guess it'll be back to the drawing board.
        $results = array( 
            'id' => $theAuthor->id,
            'author' => $theAuthor->name
        );
        echo json_encode($results);
    } 
    else 
    {
        fail("Author", "Created");
    }
}
//exit();
