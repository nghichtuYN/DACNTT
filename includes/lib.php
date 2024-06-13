<?php

function UploadFile($inputName, $Folder)
{
    if($_FILES[$inputName]["error"]!=0)
        return "";
    $filename = $_FILES[$inputName]["name"];
    $tempfile = $_FILES[$inputName]["tmp_name"];
    move_uploaded_file($tempfile,"$Folder/$filename");
    return $filename;
}
function ShowOption($rows, $valueCol, $nameCol,$selectedID)
{
    foreach($rows as $row)
    {
        $value = $row[$valueCol];
        $name = $row[$nameCol];
        $selected = ($value==$selectedID)?"selected":"";
        echo "<option value=\"$value\" $selected>$name</option>";
    }
}
?>