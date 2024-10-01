<?php
/*
        Mở kết nối đến cơ sở dữ liệu sử dụng PDO    
    */

function pdo_get_connection()
{
    $dburl = "mysql:host=localhost;dbname=duan11;charset=utf8";
    $usename = "root";
    $password = "";
    $conn = new PDO($dburl, $usename, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

/**
 * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh sql
 * @param array $ảgs mảng giá trị cung cấp cho các tham số của $sql
 * @throws PDOException lỗi thực thi câu lệnh
 */

function pdo_execute_bill_order($sql, ...$params) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        
        $stmt->execute($params);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}

function pdo_execute($sql, $params = array())
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
function pdo_execute_lastInsertId($sql, ...$params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}


/**
 * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
 * @param string @sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng các bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */

function pdo_query($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

function pdo_query_search($sql, $params = []) {
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return array mảng chứa bản ghi
 * @throws PDOException lỗi thực thi câu lệnh
 */

function pdo_query_one($sql, $params = [])
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
function pdo_query_one_cart($sql, $params = []) {
    $stmt = pdo_get_connection()->prepare($sql);
    $stmt->execute($params); // Ensure $params is an array
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Thực thi câu lệnh sql truy vấn một giá trị
 * @param string $sql câu lệnh sql
 * @param array $args mảng giá trị cung cấp cho các tham số của $sql
 * @return giá trị
 * @throws PDOException lỗi thực thi câu lệnh
 */

function pdo_query_value($sql)
{ {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }
}

function pdo_query_value_order($sql, $params = [])
{
    $pdo = pdo_get_connection();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn();
}

