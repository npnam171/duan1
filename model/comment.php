<?php 
 function danhsach_binhluan(){
    $sql = "select * from comment";
    $resuft = pdo_query($sql);
    return $resuft;
 }
 function del_binhluan($comment_id){
    $sql = "delete from comment where comment_id = $comment_id";
    pdo_execute($sql);
 }
 function add_binhluan($text,$u_id,$date,$pro_id){
   $sql = "insert into `comment` (`text`,`u_id`,`pro_id`,`date`) values('$text','$u_id','$pro_id','$date')";
   pdo_execute($sql);
 }

 function getall_binhluan($pro_id){
   $sql = "select comment.text,comment.comment_id, comment.date, user.full_name,user.role,user.email,comment.u_id, user.avatar_url from comment
   inner join user on comment.u_id = user.user_id
   where comment.pro_id = $pro_id";
   $resuft = pdo_query($sql);
   return $resuft;
}
function chitiet_binhluan(){
   $sql = "select comment.comment_id , comment.text,comment.date ,user.full_name,user.email,user.avatar_url, product.product_name , product.avatar_url as anhsp FROM comment
   INNER JOIN user on user.user_id = comment.u_id
   INNER JOIN product on product.pro_id = comment.pro_id";
   return pdo_query($sql);
}

?>