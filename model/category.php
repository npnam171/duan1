<?php 
    function danhsach_dm(){
        $sql = "SELECT * From category";
        $result = pdo_query($sql);
        return $result;
    }
    function them_dm($category_name){
        $sql = "INSERT INTO `category` (category_name) VALUES ('$category_name')";
        pdo_execute($sql);
    }
    function getone_category($category_id){
        $sql = "SELECT * FROM category WHERE category_id = $category_id";
        $result = pdo_query_one($sql);
        return $result;
    }
    function edit_category($category_id, $category_name){
        $sql = "UPDATE `category` set `category_name`='$category_name' WHERE category_id = '$category_id'";
        pdo_execute($sql);
    }
    function del_category($category_id){
        $sql = "DELETE FROM `category` WHERE `category_id` = $category_id";
        pdo_execute($sql);
    }

?>