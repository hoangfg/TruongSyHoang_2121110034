<?php

namespace App\Libraries;

class Upload
{
    public static function saveFile($args = [])
    {
        $uploadOK = true;
        $message = "";
        if (is_array($args) && array_key_exists('path_dir', $args) == true && array_key_exists('file', $args) == true) {
            $path_dir = $args['path_dir'];
            $file = $args['file'];
            $file_name = $file['name'];
            $path_file_name = $path_dir . basename($file_name);
            $type_file = strtolower(pathinfo($path_file_name, PATHINFO_EXTENSION));
            $extension = null;
            $maxsize = null;
            $rename = null;
            if (array_key_exists('extension', $args) == true) {
                $extension = $args['extension'];
            }
            if (array_key_exists('maxsize', $args) == true) {
                $maxsize = $args['maxsize'];
            }
            if (array_key_exists('rename', $args) == true) {
                $rename = $args['rename'];
                $path_file_name = $path_dir . $rename . '.' . $type_file;
                $file_name = $rename . '.' . $type_file;
            }
            /* check */
            if (!in_array($type_file, $extension)) {
                $uploadOK = false; //ko ho tro
                $message = 'Không hỗ trợ định dạng';
            } else if (file_exists($path_file_name)) {
                $uploadOK = false; //tap tin da ton tai
                $message = 'Tập tin đã tồn tại';
            } else if ($file["size"] > $maxsize) {
                $uploadOK = false;
                $message = 'Kích thước quá lớn';
            }
        } else {
            $uploadOK = false;
            $message = 'tham số truyền vào không đúng';
        }

        if ($uploadOK == true) {
            if (move_uploaded_file($file["tmp_name"], $path_file_name)) {
                $uploadOK = true;
            }
        }
        return ['success' => $uploadOK, 'result' => $file_name, 'message' => $message];
    }
    public static function deleteFile($args = [])
    {
        if (is_array($args) && array_key_exists('path_dir', $args) == true && array_key_exists('file', $args) == true) {
            $path_file_name = $args['path_dir'] . basename($args['file']);
            unlink($path_file_name);
        }
    }
}
