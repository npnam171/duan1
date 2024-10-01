<?php
function loadall_thongke($kyw = "") {
  $sql = "SELECT category.category_id AS madm, category.category_name AS tendm, 
                  COUNT(product.product_id) AS countsp, 
                  MIN(product.product_sale_price) AS minprice, 
                  MAX(product.product_sale_price) AS maxprice, 
                  AVG(product.product_sale_price) AS avgprice, 
                  SUM(product.product_sale_price) AS sumprice";
  $sql .= " FROM product";
  $sql .= " LEFT JOIN category ON category.category_id = product.category_id";
  $sql .= " WHERE 1";
  if ($kyw != "") {
    $sql .= " AND category.category_name LIKE '%" . $kyw . "%'";
  }
  $sql .= " GROUP BY category.category_id";
  $sql .= " ORDER BY category.category_id DESC";

  $listtk = pdo_query($sql);
  return $listtk;
}

// TopSalePr
function tongsanphamdaban() {
  $sql = "SELECT SUM(dhct.quantity) AS tong_so_san_pham
          FROM bill AS dh
          JOIN bill_item AS dhct ON dh.bill_id = dhct.bill_id
          WHERE dh.bill_status = 3";
  return pdo_query($sql);
}

function tongdoanhthu() {
  $sql = "SELECT SUM(total_price) AS tong_tong_gia
          FROM bill
          WHERE bill_status = 3";
  return pdo_query($sql);
}

function tk_don() {
  $sql = "SELECT bill.bill_code, users.full_name, bill.created_datetime AS order_date, bill.bill_status AS process, bill.total_price,
          (SELECT COUNT(*) FROM bill) AS tong_don_7,
          (SELECT SUM(total_price) FROM bill) AS tong_tien_7,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 0) AS tong_don_0,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 0) AS tong_tien_0,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 1) AS tong_don_1,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 1) AS tong_tien_1,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 2) AS tong_don_2,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 2) AS tong_tien_2,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 3) AS tong_don_3,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 3) AS tong_tien_3,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 4) AS tong_don_4,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 4) AS tong_tien_4,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 5) AS tong_don_5,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 5) AS tong_tien_5,
          (SELECT COUNT(bill_status) FROM bill WHERE bill_status = 6) AS tong_don_6,
          (SELECT SUM(total_price) FROM bill WHERE bill_status = 6) AS tong_tien_6
          FROM bill
          JOIN users ON users.user_id = bill.user_id
          ORDER BY bill.total_price DESC";
  return pdo_query($sql);
}

function trang_thai_don($a) {
  $sql = "SELECT bill.bill_code, users.full_name, bill.created_datetime AS order_date, bill.bill_status AS process, bill.total_price
          FROM bill
          JOIN users ON users.user_id = bill.user_id
          WHERE bill.bill_status = $a
          ORDER BY bill.total_price DESC";
  return pdo_query($sql);
}

function loc_don_ngay($a, $b) {
  $sql = "SELECT bill.bill_code, users.full_name, bill.created_datetime AS order_date, bill.bill_status AS process, bill.total_price,
          (SELECT COUNT(bill.bill_code) FROM bill WHERE bill.created_datetime BETWEEN '$a 00:00' AND '$b 23:59') AS tong_don,
          (SELECT SUM(bill.total_price) FROM bill WHERE bill.created_datetime BETWEEN '$a 00:00' AND '$b 23:59') AS tong_tien
          FROM bill
          JOIN users ON users.user_id = bill.user_id
          WHERE bill.created_datetime BETWEEN '$a 00:00' AND '$b 23:59'
          ORDER BY bill.total_price DESC";
  return pdo_query($sql);
}

function sw_chon($a) {
  switch ($a) {
    case 0:
      return 'Chờ xác nhận';
    case 1:
      return 'Đã xác nhận';
    case 2:
      return 'Đang giao hàng';
    case 3:
      return 'Giao Hàng Thành Công';
    case 4:
      return 'Giao Hàng Thất Bại';
    case 5:
      return 'Hủy đơn(admin)';
    case 6:
      return 'Hủy đơn(khách hàng)';
    case 7:
      return 'Tất Cả';
    default:
      return 'Không xác định';
  }
}

function loc_date_sp($start_date, $end_date) {
  $sql = "SELECT p.product_name, p.product_sale_price AS price, c.category_name AS tendanhmuc, bi.quantity,
          (bi.quantity * p.product_sale_price) AS tongtien, b.created_datetime AS order_date
          FROM product p
          JOIN bill_item bi ON p.product_id = bi.product_id
          JOIN bill b ON bi.bill_id = b.bill_id
          JOIN category c ON p.category_id = c.category_id
          WHERE b.bill_status = 3 AND b.created_datetime BETWEEN '$start_date 00:00' AND '$end_date 23:59'
          ORDER BY bi.quantity DESC";
  return pdo_query($sql);
}

function loc_sp_theo_ngay($days_ago) {
  $sql = "SELECT p.product_name, p.product_sale_price AS price, c.category_name AS tendanhmuc, bi.quantity,
          (bi.quantity * p.product_sale_price) AS tongtien, b.created_datetime AS order_date
          FROM product p
          JOIN bill_item bi ON p.product_id = bi.product_id
          JOIN bill b ON bi.bill_id = b.bill_id
          JOIN category c ON p.category_id = c.category_id
          WHERE b.bill_status = 3 AND b.created_datetime >= (CURRENT_DATE - INTERVAL $days_ago DAY)
          ORDER BY bi.quantity DESC";
  return pdo_query($sql);
}

function sp_ban_chay() {
  $sql = "SELECT p.product_id, p.product_name, p.product_sale_price AS price, c.category_name AS tendanhmuc, bi.quantity,
                 (bi.quantity * p.product_sale_price) AS tongtien, b.created_datetime AS order_date
          FROM product p
          JOIN bill_item bi ON p.product_id = bi.product_id
          JOIN bill b ON bi.bill_id = b.bill_id
          JOIN category c ON p.category_id = c.category_id
          WHERE b.bill_status = 3
          ORDER BY tongtien DESC";
  return pdo_query($sql);
}

function sp_doanhthu_cao() {
  $sql = "SELECT p.product_id, p.product_name, SUM(bi.quantity * p.product_sale_price) AS tongtien
          FROM product p
          JOIN bill_item bi ON p.product_id = bi.product_id
          JOIN bill b ON bi.bill_id = b.bill_id
          WHERE b.bill_status = 3
          GROUP BY p.product_id, p.product_name
          ORDER BY tongtien DESC
          LIMIT 5"; // Giới hạn chỉ lấy top 5 sản phẩm
  return pdo_query($sql);
}

