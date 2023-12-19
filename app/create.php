<?php
    
    include '../inc/header.php';

    $title = $body = "";
    $titleErr = $bodyErr = "";

    if (isset($_POST['submit'])) {
        if (empty($_POST['title'])) {
            $titleErr = "Title is empty";
        } else {
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        if (empty($_POST['body'])) {
            $bodyErr = "Body is empty";
        } else {
            $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }
    }

    # Establish DB connection
    $db = new Database();
    $conn = $db->getConnection();

    if (!$conn) {
        die("Connection Failed");
    }

    # Raw SQL to be executed
    $sql = "INSERT INTO blog (title, body) VALUES ('$title', '$body')";
    
    # Validate inputs and perform SQL operation
    if ($title && $body) {
        if (pg_query($conn, $sql)){
            header("Location: retrieve.php");        
        } else {
            echo 'Error'. pg_last_error($conn);
        }
    } 
    
    $db->closeConnection();
?>

<div>
    <div class="container-md mt-5 w-75">
        <div class="row">
            <div class="col-8">
                <h3>Post</h3>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="mt-5">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input class="form-control" type="text" id="title" name="title" placeholder="Blog Title" aria-label="default input example" value="<?php echo $title; ?>">
                        <span class="text-danger"><?php echo $titleErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="3"><?php echo $body; ?></textarea>
                        <span class="text-danger"><?php echo $bodyErr; ?></span>
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
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
