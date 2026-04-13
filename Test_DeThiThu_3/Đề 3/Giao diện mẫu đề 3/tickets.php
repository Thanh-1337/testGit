<?php
session_start();
function ktrcsv(){
    $file="tickets.csv";
    if(!file_exists($file)){
        $eror="<div class='alert alert-warning'>File csv Không Tồn Tại</div>";
    }
    else{
        $stt=1;
        $handle=fopen($file,"r");
        while(($data=fgetcsv($handle,"0",","))!== false){
            echo "<tr>";
            echo "<td>".$stt++."</td>";
            echo "<td>".$data[0]."</td>";
            echo "<td>".$data[1]."</td>";
            echo "<td>".$data[2]."</td>";
            echo "<td>".$data[3]."</td>";
            echo "<td>".$data[4]."</td>";
            echo "<td>".$data[5]."</td>";
            echo "</tr>";
        }
        fclose($handle);
    }
}

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Danh sách yêu cầu - IT Helpdesk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">IT Helpdesk</a>
            <div>
                <a href="ticket_add.php" class="btn btn-light btn-sm">Thêm yêu cầu</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5>Danh sách yêu cầu hỗ trợ</h5>
            </div>
            <div class="card-body">

                <!-- Khi chưa có dữ liệu -->
                
                <div class="alert alert-warning"></div>
                
                <!-- Bảng dữ liệu -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>STT</th>
                                <th>Mã yêu cầu</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Mức độ</th>
                                <th>Nội dung</th>
                                <th>Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            ktrcsv();
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</body>

</html>