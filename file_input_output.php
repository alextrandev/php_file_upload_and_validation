<?php
//show all files in a directory
$dir_content = scandir("./uploads_copy");
echo "<pre>", print_r($dir_content), "</pre>";
