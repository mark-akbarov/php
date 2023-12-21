<?php 
    include '../inc/header.php'; 

    $db = new Database();
    $conn = $db->getConnection();

    if (!$conn) {
        die("Connection Failed");
    }

    if (isset($_GET['id'])) {
        // Retrieve the 'id' value from the URL
        $blogId = $_GET['id'];
    
    } else {
        // Handle the case where 'id' parameter is not set
        echo "Blog ID is missing in the URL.";
    }

    $sql = "DELETE FROM blog WHERE id=$blogId";

    $query = pg_query($conn, $sql);
    
    if (!$query) {
        die("Query failed to execute: " . pg_last_error($conn));
    }
    
    $blog = pg_fetch_assoc($query);

    pg_free_result($query);

    $db->closeConnection();
?>
<h3>Blog has been deleted</h3>
</div>   
</body>
