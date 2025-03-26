# PHP-quote-project by Cameron M. Guinnee

## This is an API that uses GET, POST, PUT, and DELETE requests to update a database containing famous quotes. 

Link: 
https://php-quote-project.onrender.com

| Param | Desc |
| ----  | ---- |
| quotes/ | This returns an array of JSON containers w/ all the quotes in the database. |
| quotes/?id=1 | This returns the quote whose id matches the one that was provided. | 
| authors/ | This returns an array of JSON containers w/ all the authors in the database. |
| authors/?id=1 | This returns the author whose id matches the one that was provided. |
| categories/ | This returns an array of JSON containers w/ all the categories in the database. | 
| categories/?id=1 | This returns the category whose id matches the one that was provided. | 
| quotes/?author_id=1 | This returns all quotes belonging to the author whose id matches the provided author_id. |
| quotes/?category_id=1 | This returns all quotes in the category whose id matches the provided category_id. |
| quotes/?author_id=1&category_id=1 | This returns all quotes that belong to the author w/ the given author_id and which are in the category w/ the given category_id. | 
