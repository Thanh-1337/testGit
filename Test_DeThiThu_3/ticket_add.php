<?php
session_start();
$error=[];
$success=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $file="tickets.csv";
    $ticket_id=$_POST["ticket_id"];
    $fullname=$_POST["fullname"];
    $email=$_POST["email"];
    $priority=$_POST["priority"];
    $content=$_POST["content"];
    $note=$_POST["note"];
    if($ticket_id==""){
        $error[]="Mã yêu cầu không được để trống";
    }
    if($fullname==""){
        $error[]="Họ tên không được để trống";
    }
    if($email==""){
        $error[]="Email không được để trống";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error[]="Email không hợp lệ";
    }
    if(!in_array($priority,["Thấp","Trung bình","Cao"])){
        $error[]="Mức độ không được để trống";
    }
    if($content==""){
        $error[]="Nội dung không được để trống";
    }
    if($note==""){
        $error[]="Ghi chú không được để trống";
    }
    if(file_exists($file)){
        $handle=fopen($file,"r");
        while(($data=fgetcsv($handle))!==false){
            if($data[0]==$ticket_id){
                $error[]="Mã yêu cầu đã tồn tại";
                break;
            }
        }
        fclose($handle);
    }
    else{
        $error[]="File không tồn tại";
    }
    if(empty($error)){
        $handle=fopen($file,"a");
        fputcsv($handle,[$ticket_id,$fullname,$email,$priority,$content,$note]);
        fclose($handle);
        $success=true;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Tiếp nhận yêu cầu - IT Helpdesk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="tickets.php">IT Helpdesk</a>
            <div>
                <a href="tickets.php" class="btn btn-light btn-sm">Danh sách yêu cầu</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Đăng xuất</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5>Tiếp nhận yêu cầu hỗ trợ</h5>
            </div>
            <div class="card-body">

                <!-- Thông báo lỗi -->
                 <?php if(!empty($error)): ?>
                    <div class="alert alert-danger">
                   <?php foreach($error as $err): ?>
                        <p><?php echo $err; ?></p>
                   <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <!-- Thông báo thành công -->
                 <?php if($success): ?>
                <div class="alert alert-success">
                    <?php echo "Thêm yêu cầu thành công!"; ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="">

                    <div class="mb-3">
                        <label class="form-label">Mã yêu cầu</label>
                        <input type="text" name="ticket_id" class="form-control" placeholder="VD: T001">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="fullname" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@email.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mức độ</label>
                        <select name="priority" class="form-select">
                            <option value="">-- Chọn mức độ --</option>
                            <option>Thấp</option>
                            <option>Trung bình</option>
                            <option>Cao</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="note" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="tickets.php" class="btn btn-secondary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Lưu yêu cầu</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>

</html>