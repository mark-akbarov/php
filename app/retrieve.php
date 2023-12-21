<?php 

    include '../inc/header.php'; 

    // Establish DB Connection
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

    // Raw SQL query
    $sql = "SELECT id, title, body FROM blog WHERE id=$blogId";
    
    $query = pg_query($conn, $sql);
    
    if (!$query) {
        die("Query failed to execute: " . pg_last_error($conn));
    }
    
    $blog = pg_fetch_assoc($query);

    pg_free_result($query);

    $db->closeConnection();

?>

<div class="container-md mt-5 w-50">
    <h3>Retrieve</h3>
    <?php if (empty($blog)): ?>
        <p>Blog Not Found.</p>
    <?php else: ?>
        <div class="card text-center mt-5 mb-5">
            <div class="card-header">
                Blog No: <?php echo $blog["id"]; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $blog["title"]; ?></h5>
                <p class="card-text"><?php echo $blog["body"]; ?></p>
                <a href="delete.php?id=<?php echo $blog['id']; ?>" class="btn btn-danger">Delete</a>
                <a href="update.php?id=<?php echo $blog['id']; ?>" class="btn btn-warning">Update</a>
            </div>
            <div class="card-footer text-body-secondary">
                2 days ago
            </div>
        </div>
    <?php endif; ?>

</div>
</div>   
</body>
