
<div style="margin-top: 50px;" class="container">
    <div class="row">
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Id Bình Luận</th>
      <th scope="col">Nội Dung</th>
      <th scope="col">Khách Hàng</th>
      <th scope="col">Ảnh Khách Hàng</th>
      <th scope="col">Sản Phẩm</th>
      <th scope="col">ảnh sp</th>
      <th scope="col">Email</th>
      <th scope="col">Ngày Bình Luận</th>
      <th scope="col">Act</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($dsbl as $value):?>

    <tr>
      <th scope="row"><?php echo $value['comment_id']?></th>
      <td><?php echo $value['text']?></td>
      <td><?php echo $value['fullname']?></td>
      <td><?php echo $value['email']?></td>
      <td><img width="50px" src="../uploads/<?php echo $value['image']?>" alt=""></td>
      <td><?php echo $value['name_sp']?></td>
      <td><img width="50px" src="../uploads/<?php echo $value['anhsp']?>" alt=""></td>
      
      <td><?php echo $value['ngay_cmt']?></td>
      <td><a href="?act=delbl&idbl=<?php echo $value['comment_id']?>">Xóa</a></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
    </div>
</div>
