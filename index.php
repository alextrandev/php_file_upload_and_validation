<?php
if (isset($_POST['file_upload'])) {
    try {
        if ($_FILES['sample_file']['name'] !== "") :
            $fileName = $_FILES['sample_file']['name'];
            $filePath = $_FILES['sample_file']['tmp_name']; //get the path of the file
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // get extension
            $newFileName = time() . "." . $fileExtension; //change file name
            $fileSize = $_FILES['sample_file']['size'] / 1024 / 1024;
            // $fileSize = getimagesize($tmpPath); // only for image type

            // print file info
            // echo nl2br(
            //     "Filename: $fileName
            //     File path: $filePath
            //     Extension: $fileExtension
            //     Size: $fileSize"
            // );

            // unsecure extension validation
            // if ($fileNameArr[1] == "jpg" || $fileNameArr[1] == "png" || $fileNameArr[1] == "gif") {
            //     move_uploaded_file($tmpPath, "uploads/$newFileName");
            // } else {
            //     echo 'Invalid file type';
            // }

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $filePath);
            if (
                $mime == 'image/jpeg'
                || $mime == 'image/png'
                || $mime == 'image/gif'
                || $mime == 'application/pdf'
            ) {
                if ($fileSize <= 25) {
                    copy($filePath, "uploads_copy/$newFileName"); //not deleting the src file
                    move_uploaded_file($filePath, "uploads/$newFileName");
                } else {
                    throw new Exception("File must be within 25MB");
                }
            } else {
                throw new Exception("Wrong file format");
            };
            finfo_close($finfo);
        else : throw new Exception("Please upload a file");
        endif;
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File upload and validation</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td><label for="file">Select an image file:</label></td>
                <td><input type="file" name="sample_file" id="file"></td>
            </tr>
            <tr>
                <td><a href="file_input_output.php">View all files</a></td>
                <td><input type="submit" value="Submit" name="file_upload"></td>
            </tr>
        </table>
        <p style="color:red"><?= $error_msg ?? "" ?></p>
    </form>
</body>

</html>