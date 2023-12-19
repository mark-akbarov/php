<?php 
    include '../inc/header.php'; 

    # Establish Connection
    $db = new Database();
    $conn = $db->getConnection();

    if (!$conn) {
        die("Connection Failed");
    }

    # Raw SQL query
    $sql = "SELECT title, body FROM blog";
    $query = pg_query($conn, $sql);
    
    if (!$query) {
        die("Query failed to execute: " . pg_last_error($conn));
    }

    $blogs = pg_fetch_all($query);

    $db->closeConnection();
?>
    <h3>Blogs</h3>
    <?php foreach ($blogs as $blog): ?>
        <p><?php echo $blog['title'] ?></p>
        <p><?php echo $blog['body'] ?></p>
    <?php endforeach; ?>
    
    <div class="card" style="width: 18rem;">
    <img src="..." class="card-img-top" alt="...">
    <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    </div>
    </div>

</div>   
</body>
