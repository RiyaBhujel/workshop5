<?php 
include 'includes/header.php'; 


$serverMethod = $_SERVER['REQUEST_METHOD'];

try {
    if ($serverMethod === "POST" && isset($_POST['uploadbtn']) && isset($_FILES['portfolio'])) {
        $file = $_FILES['portfolio'];

        $fileSize = $file['size'];
        if ($fileSize > 2*1024*1024) {
            throw new Exception("File size exceeded 2MB");
        }

        $filename = $file['tmp_name'];
        $destination = __DIR__.'/uploads/'.$file['name'];

        
        if (!file_exists(__DIR__.'/uploads')) {
            mkdir(__DIR__.'/uploads', 0777, true);
        }

        if (move_uploaded_file($filename, $destination)) {
            echo "<br><h3 style='color:green;'>File uploaded successfully</h3>";
        } else {
            throw new Exception("Failed to move uploaded file");
        }
    }
} catch(Exception $e) {
    $error = $e->getMessage();
    echo "<h3 style='color:red;'>$error</h3>";
}
?>

<form class="mid-section" method="POST" enctype="multipart/form-data">
    <input type="file" name="portfolio" accept=".pdf,.png,.jpg,.pptx">
    <button type="submit" name="uploadbtn">Upload</button>
</form>

<?php include 'includes/footer.php'; ?>
