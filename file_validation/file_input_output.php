<?php
//show all files in a directory
$dir_content = scandir("./uploads_copy");
echo "<pre>", print_r($dir_content), "</pre>";

//print the content of a text file
$file = file_get_contents('./uploads_copy/note.md');
echo "<pre>", $file, "</pre>";
