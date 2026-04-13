<?php
session_start();
$eror="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $password=$_POST["password"];
    if($username == "admin" && $password=="123"){
        header("Location: ticket_add.php");
        exit();
    }
    else{
       echo "<div class='alert alert-danger'>Sai Mật Khẩu</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - IT Helpdesk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center bg-dark text-white">
                        <h4>IT Helpdesk - Đăng nhập</h4>
                    </div>
                    <div class="card-body">

                        <!-- Thông báo lỗi -->
                        <div class="alert alert-danger d-none">
                            
                                    <div class='alert alert-danger'>
                                        Sai Mật Khẩu
                                    </div>
                                
                            
                        </div>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark">
                                    Đăng nhập
                                </button>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer text-center text-muted">
                        © 2026 IT Helpdesk
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>