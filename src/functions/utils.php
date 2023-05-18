<?php
function getUniqueKey($length = 10)
{
    $key = "";
    $keys = array_merge(range(0, 9), range('a', 'z'));
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}


function uploadFIle($file, $path, $name = null, $extension = null)
{
    $extension = $extension ?? explode('.', $file['name'])[1];
    $name = $name ?? getUniqueKey(25);
    $name = $name . '.' . $extension;
    $tmp_name = $file['tmp_name'];
    $path = $path . $name;
    if (move_uploaded_file($tmp_name, $path)) {
        return $name;
    }
    return false;
}


function deleteFile($path)
{
    if (file_exists($path)) {
        unlink($path);
        return true;
    }
    return false;
}
