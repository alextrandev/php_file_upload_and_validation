<?php
if (isset($_POST['file_upload'])) {
    $fileName = $_FILES['sample_file']['name']; //get the file name from the FILES superglobal
    $tmpPath = $_FILES['sample_file']['tmp_name']; //get the path of the file. file will be store in a temp folder when uploaded
    $fileNameArr = explode('.', $fileName);
    $newFileName = "file." . $fileNameArr[1]; //change file name

    echo nl2br(
        "Filename: $fileName
        Temp path: $tmpPath
        Name: $fileNameArr[0]
        Extension: $fileNameArr[1]"
    );

    move_uploaded_file($tmpPath, "uploads/$newFileName"); //move the file to the uploads folder
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
                <td><label for="file">Select a file:</label></td>
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