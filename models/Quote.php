<?php 
class Quote {
    private $conn;
    private $table = 'quotes';

    public $id;
    public $theQuote;
    public $theAuthor;
    public $theCategory;

    public $author_id;
    public $category_id; 
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create() 
    {
        // I forgot that, in my postgreSQL database, the author id and category id are formated as author_id and category_id respectively. 
        $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) 
            VALUES (:quote, :authorId, :categoryId);';

        $stmt = $this->conn->prepare($query);

        $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
        
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
        $stmt->bindParam(':quote', $this->theQuote);
        
        $stmt->bindParam(':authorId', $this->author_id);
        $stmt->bindParam(':categoryId', $this->category_id); 
        
        if ($stmt->execute()) 
        {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        printf("ErrorL %s.\n", $stmt->error);
        return false;
    }

    function read() 
    {
        $query = 'SELECT q.id, q.quote, a.author, c.category 
            FROM ' . $this->table . ' q 
            LEFT JOIN authors a on q.author_id = a.id
            LEFT JOIN categories c on q.category_id = c.id;';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function read_author() 
    {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.author_id = a.id
            LEFT JOIN categories c on q.category_id = c.id
            WHERE a.id = :authorId';

        $stmt = $this->conn->prepare($query);        
        $stmt->bindParam(':authorId', $this->author_id);
        
        $stmt->execute();
        return $stmt;
    }

    function read_category() 
    {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.author_id = a.id
            LEFT JOIN categories c on q.category_id = c.id
            WHERE c.id = :categoryId';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categoryId', $this->category_id);
        
        $stmt->execute();
        return $stmt;
    }

    function read_author_and_category() 
    {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.author_id = a.id
            LEFT JOIN categories c on q.category_id = c.id
            WHERE a.id = :authorId AND c.id = :categoryId';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':categoryId', $this->category_id);
        $stmt->bindParam(':authorId', $this->author_id);
    
        
        $stmt->execute();

        return $stmt;
    }

    function read_single() 
    {
        $query = 'SELECT q.id, q.quote, a.author, c.category, a.id AS "authorId", c.id AS "categoryId"
            FROM ' . $this->table . ' q
            LEFT JOIN authors a on  q.author_id = a.id
            LEFT JOIN categories c on q.category_id = c.id
            WHERE q.id = :id;';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) 
        { 
            $this->theQuote = $row['quote'];
            $this->theAuthor = $row['author'];
            $this->theCategory = $row['category'];
            $this->author_id = $row['authorId'];
            $this->category_id = $row['categoryId'];
        }
    }

    function update() 
    {
        // I forgot that, in my postgreSQL database, the author id and category id are formatted as author_id and category_id respectively. 
        $query = 'UPDATE ' . $this->table . ' 
            SET quote = :quote, 
                author_id = :authorId, 
                category_id = :categoryId
            WHERE id = :id;';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->theQuote = htmlspecialchars(strip_tags($this->theQuote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->theQuote);
        $stmt->bindParam(':authorId', $this->author_id);
        $stmt->bindParam(':categoryId', $this->category_id);
        
        if ($stmt->execute()) 
        {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete() 
    {
        $query = 'DELETE FROM ' . $this->table . '
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}
