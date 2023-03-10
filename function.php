<?php
function deleteChildrenMenu($parent_id,$menuList,$conn){
    foreach($menuList as $item){
        if($item['parent_id'] == $parent_id){
            deleteChildrenMenu($item['id'],$menuList,$conn);
            mysqli_query($conn, "DELETE FROM `menu` WHERE `id` = " . $item['id']);
        }
    }
}
function showMenuSelectBox($list, $num, $parent_id) {
    $num++;
    foreach ($list as $item) {
        $selected = "";
        if($item['id'] == $parent_id){
            $selected = "selected";
        }
        echo "<option value='".$item['id']."' ".$selected.">" . str_repeat("---", $num - 1) . $item['name'] . "</option>";
        if (!empty($item['children'])) {
            showMenuSelectBox($item['children'], $num, $parent_id);
        }
    }
}

function showMenuTree($list, $num, $config_name) {
    $num++;
    foreach ($list as $item) {
        echo renderTemplate('admin/li-template.php', array('num' => $num, 'config_name' => $config_name, 'row' => $item));
        if (!empty($item['children'])) {
            showMenuTree($item['children'], $num, $config_name);
        }
    }
}

function renderTemplate($filePath, $params) {
    $output = "";
    // Extract the variables to a local namespace
    extract($params);

    // Start output buffering
    ob_start();

    // Include the template file
    include $filePath;

    // End buffering and return its contents
    $output = ob_get_clean();
    return $output;
}

function createMenuTree(&$menuList, $parent_id) {
    $menuTree = array();
    foreach ($menuList as $key => $menu) {
        if ($menu['parent_id'] == $parent_id) {
            $children = createMenuTree($menuList, $menu['id']);
            if ($children) {
                $menu['children'] = $children;
            }
            $menuTree[] = $menu;
            unset($menuList[$key]);
        }
    }
    return $menuTree;
}

function getAllFiles() {
    $allFiles = array();
    $allDirs = glob('uploads/*');
    foreach ($allDirs as $dir) {
        $allFiles = array_merge($allFiles, glob($dir . "/*"));
    }
    return $allFiles;
}

function uploadFiles($uploadedFiles) {
    $files = array();
    $errors = array();
    $returnFiles = array();
    //X??? l?? gom d??? li???u v??o t???ng file ???? upload
    // var_dump($uploadedFiles);exit;
    foreach ($uploadedFiles as $key => $values) {
        if (is_array($values)) {
            foreach ($values as $index => $value) {
                $files[$index][$key] = $value;
            }
        } else {
            $files[$key] = $values;
        }
    }
    $uploadPath = "../image/image-quanao/uploads/" . date('d-m-Y', time());
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }
    if (is_array(reset($files))) { //Up nhi???u ???nh
        foreach ($files as $file) {
            $result = processUploadFile($file, $uploadPath);
            if ($result['error']) {
                $errors[] = $result['message'];
            } else {
                $returnFiles[] = $result['path'];
            }
        }
    } else { //Up 1 ???nh
        $result = processUploadFile($files, $uploadPath);
        if ($result['error']) {
            return array(
                'errors' => $result['message']
            );
        } else {
            return array(
                'path' => $result['path']
            );
        }
    }
    return array(
        'errors' => $errors,
        'uploaded_files' => $returnFiles
    );
}

function processUploadFile($file, $uploadPath) {
    $file = validateUploadFile($file, $uploadPath);
    if ($file != false) {
        $file["name"] = str_replace(' ', '_', $file["name"]);
        if (move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"])) {
            return array(
                'error' => false,
                'path' => str_replace('../', '', $uploadPath) . '/' . $file["name"]
            );
        }
    } else {
        return array(
            'error' => false,
            'message' => "File t???i l??n " . basename($file["name"]) . " kh??ng h???p l???."
        );
    }
}

//Check file h???p l???
function validateUploadFile($file, $uploadPath) {
    //Ki???m tra xem c?? v?????t qu?? dung l?????ng cho ph??p kh??ng?
    if ($file['size'] > 2 * 1024 * 1024) { //max upload is 2 Mb = 2 * 1024 kb * 1024 bite
        return false;
    }
    //Ki???m tra xem ki???u file c?? h???p l??? kh??ng?
    $validTypes = array("jpg", "jpeg", "png", "bmp", "xlsx", "xls");
    $fileType = strtolower(substr($file['name'], strrpos($file['name'], ".") + 1));
    if (!in_array($fileType, $validTypes)) {
        return false;
    }
    //Check xem file ???? t???n t???i ch??a? N???u t???n t???i th?? ?????i t??n
    $num = 0;
    $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    while (file_exists($uploadPath . '/' . $fileName . '.' . $fileType)) {
        $fileName = $fileName . "(" . $num . ")";
        $num++;
    }
    if ($num != 0) {
        $fileName = substr($file['name'], 0, strrpos($file['name'], ".")) . "(" . $num . ")";
    } else {
        $fileName = substr($file['name'], 0, strrpos($file['name'], "."));
    }
    $file['name'] = $fileName . '.' . $fileType;
    return $file;
}

//H??m login sau khi m???ng x?? h???i tr??? d??? li???u v???
function loginFromSocialCallBack($socialUser) {
    include './connect.php';
    $result = mysqli_query($conn, "Select `id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    if ($result->num_rows == 0) {
        $result = mysqli_query($con, "INSERT INTO `user` (`fullname`,`email`, `status`, `created_time`, `last_updated`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', 1, " . time() . ", '" . time() . "');");
        if (!$result) {
            echo mysqli_error($con);
            exit;
        }
        $result = mysqli_query($con, "Select `id`,`username`,`email`,`fullname` from `user` WHERE `email` ='" . $socialUser['email'] . "'");
    }
    if ($result->num_rows > 0) {
        $user = mysqli_fetch_assoc($result);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['current_user'] = $user;
        header('Location: ./login.php');
    }
}

function validateDateTime($date) {
    //Ki???m tra ?????nh d???ng ng??y th??ng xem ????ng DD/MM/YYYY hay ch??a?
    preg_match('/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/', $date, $matches);
    if (count($matches) == 0) { //N???u ng??y th??ng nh???p kh??ng ????ng ?????nh d???ng th?? $match = array(); (r???ng)
        return false;
    }
    $separateDate = explode('-', $date);
    $day = (int) $separateDate[0];
    $month = (int) $separateDate[1];
    $year = (int) $separateDate[2];
    //N???u l?? th??ng 2
    if ($month == 2) {
        if ($year % 4 == 0) { //N???u l?? n??m nhu???n
            if ($day > 29) {
                return false;
            }
        } else { //Kh??ng ph???i n??m nhu???n
            if ($day > 28) {
                return false;
            }
        }
    }
    //Check c??c th??ng kh??c
    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            if ($day > 31) {
                return false;
            }
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            if ($day > 30) {
                return false;
            }
            break;
    }
    return true;
}

?>