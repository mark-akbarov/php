<?php 

    include '../inc/header.php'; 

    # Establish Connection
    $db = new Database();
    $conn = $db->getConnection();

    if (!$conn) {
        die("Connection Failed");
    }

    # Raw SQL query
    $sql = "SELECT id, title, body FROM blog";
    $query = pg_query($conn, $sql);
    
    if (!$query) {
        die("Query failed to execute: " . pg_last_error($conn));
    }

    $blogs = pg_fetch_all($query);

    $db->closeConnection();

?>

<div class="container-md mt-5 w-50">
    <h3>Blogs</h3>
    <?php foreach ($blogs as $blog): ?>
        <div class="card text-center mt-5 mb-5">
            <div class="card-header">
                <p>Blog No: <?php echo $blog['id']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><p><?php echo $blog['title'] ?></h5>
                <p class="card-text"><p><?php echo $blog['body'] ?></p>
                <?php ?>
                <a href="retrieve.php?id=<?php echo $blog['id']; ?>" class="btn btn-primary">Read More</a>
            </div>
            <div class="card-footer text-body-secondary">
                2 days ago
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>   
</body>
