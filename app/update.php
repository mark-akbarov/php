<?php 
    
    include '../inc/header.php'; 

    $db = new Database();
    $conn = $db->getConnection();

    if (!$conn) {
        die("Connection Failed");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $blogId = $_GET['id'];
        } else {
            echo "Blog ID is missing in the URL.";
        }
        $sql = "SELECT id, title, body FROM blog WHERE id=$blogId";
        $query = pg_query($conn, $sql);
        if (!$query) {
            die("Query failed to execute: " . pg_last_error($conn));
        }
        $blog = pg_fetch_assoc($query);
        echo "GET Request Received.";
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $updateQuery = "UPDATE blog SET title='$title', body='$body' WHERE id=$id";
            if ($title || $body) {
                if (pg_query($conn, $updateQuery)){
                    echo "Blog was updated.";        
                } else {
                    echo pg_last_error($conn);
                }
            }
            
        }
        
    } else {
        http_response_code(405); // Method Not Allowed
        echo "Invalid Request Method";
    }

    pg_free_result($query);

    $db->closeConnection();

?>

<div>
    <div class="container-md mt-5 w-75">
        <div class="row">
            <div class="col-8">
                <h3>Update</h3>
                <h5 >Blog No: <?php echo $blog['id']; ?></h5>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-5">
                    <input type="hidden" id="id" name="id" value="<?php echo $blog['id']; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" aria-label="default input example" value="<?php echo $blog['title']; ?>">
                        <span class="text-danger"><?php echo $titleErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="3"><?php echo $blog['body']; ?></textarea>
                        <span class="text-danger"><?php echo $bodyErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="update" value="Update" class="btn btn-dark w-100">
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="container-sm">
                    <h3>Sidebar</h3>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
