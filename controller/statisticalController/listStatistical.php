<main class="container">
    <div class="row my-4">
        <div class="col">
            <h1 class="text-center">THỐNG KÊ SẢN PHẨM THEO LOẠI</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">MÃ DANH MỤC</th>
                            <th scope="col">TÊN DANH MỤC</th>
                            <th scope="col">SỐ LƯỢNG</th>
                            <th scope="col">GIÁ CAO NHẤT</th>
                            <th scope="col">GIÁ THẤP NHẤT</th>
                            <th scope="col">GIÁ TRUNG BÌNH</th>
                            <th scope="col">TỔNG TIỀN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($listthongke as $thongke) {
                            echo '<tr>
                                    <td>'.$count.'</td>
                                    <td>'.$thongke['madm'].'</td>
                                    <td>'.$thongke['tendm'].'</td>
                                    <td>'.$thongke['countsp'].'</td>
                                    <td>'.number_format($thongke['maxprice']).'</td>
                                    <td>'.number_format($thongke['minprice']).'</td>
                                    <td>'.number_format($thongke['avgprice']).'</td>
                                    <td>'.number_format($thongke['sumprice']).'</td>
                                  </tr>';
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</main>
<?php
$listthongke = [
    ['madm' => 'DM01', 'tendm' => 'Electronics', 'countsp' => 10, 'maxprice' => 1000, 'minprice' => 100, 'avgprice' => 550, 'sumprice' => 5500],
    ['madm' => 'DM02', 'tendm' => 'Furniture', 'countsp' => 15, 'maxprice' => 1500, 'minprice' => 200, 'avgprice' => 850, 'sumprice' => 12750],
    // Add more data as needed
];

$categories = array_column($listthongke, 'tendm');
$quantities = array_column($listthongke, 'countsp');
$maxPrices = array_column($listthongke, 'maxprice');
$minPrices = array_column($listthongke, 'minprice');
$avgPrices = array_column($listthongke, 'avgprice');
$sumPrices = array_column($listthongke, 'sumprice');
?>
