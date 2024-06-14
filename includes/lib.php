<?php

function UploadFile($files, $Folder)
{
    if ($files['files']["error"][0] != 0) {
        return "";
    }
    $filename = $files['files']["name"];
    $tempfile = $files['files']["tmp_name"];
    $file_array = array_combine($tempfile, $filename);
    foreach ($file_array as $tmp_folder => $image_name) {
        move_uploaded_file($tmp_folder, "$Folder/$image_name");
    }
    return $filename;
}
function ShowOption($rows, $valueCol, $nameCol, $selectedID)
{
    foreach ($rows as $row) {
        $value = $row[$valueCol];
        $name = $row[$nameCol];
        $selected = ($value == $selectedID) ? "selected" : "";
        echo "<option value=\"$value\" $selected>$name</option>";
    }
}
