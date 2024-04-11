<?php
if (isset($_POST['file_upload'])) {
    $fileName = $_FILES['sample_file']['name'];
    $filePath = $_FILES['sample_file']['tmp_name']; //get the path of the file
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION); // get extension
    $newFileName = time() . $fileExtension; //change file name
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
            move_uploaded_file($filePath, "uploads/$newFileName");
        } else {
            echo 'File size must be within 25MB';
        }
    } else {
        echo 'Invalid format';
    };
    finfo_close($finfo);
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
                <td></td>
                <td><input type="submit" value="Submit" name="file_upload"></td>
            </tr>
        </table>
    </form>
</body>

</html>