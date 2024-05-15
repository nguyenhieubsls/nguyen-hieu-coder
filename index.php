<!DOCTYPE html>
<html>
<!-- Head -->
<head>
    <title>Login to Hieu</title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Existing Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script type="application/x-javascript"> 
        addEventListener("load", function() { 
            setTimeout(hideURLbar, 0); 
        }, false); 
        function hideURLbar(){ 
            window.scrollTo(0,1); 
        } 
    </script>
    <!-- //Meta-Tags -->
    <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all">
    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    <!-- //Fonts -->
</head>
<!-- //Head -->
<!-- Body -->
<body>
    <h1>Đăng Nhập Vào Hệ Thống</h1>
    <div class="w3layoutscontaineragileits">
        <h2>Đăng Nhập Ngay</h2>
        <form action="#" method="post" name="log">
            <input type="text" Name="txtuser" placeholder="User" required="">
            <input type="password" id="password" Name="txtpass" placeholder="Password" required="">
            <ul class="agileinfotickwthree">
                <li>
                    <input style="margin-left: 20px;" type="radio" id="showPassword">Hiển thị mật khẩu
                    <a href="#">Quên mật khẩu?</a>
                </li>
          </ul>
            <div class="aitssendbuttonw3ls">
                <input type="submit" name="bntlogin" value="ĐĂNG NHẬP">
                <p><a class="w3_play_icon1" href="#small-dialog1"> Tạo tài khoản mới</a></p>
                <div class="clear"></div>
            </div>
          <?php
            //Gọi trang kết nối
            include('ketnoi.php');
            session_start();
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            // Login process
            if(isset($_POST['bntlogin'])) {
                $username = $_POST['txtuser'];
                $password = $_POST['txtpass'];
                //Khai báo câu lệnh truy vấn từ bảng tblthanhvien
                $sql = "SELECT * FROM tblthanhvien WHERE TenDangNhap='$username' AND MatKhau='$password'";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) == 1) {
                    $_SESSION['username'] = $username;
                    header('Location: trangchu.php');
                    exit();
                } else {
                    echo  " <div style='text-align: center; margin-top: 15px; color: red;'> Tên người dùng hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại hoặc tạo tài khoản mới.";
                }
            }
            ?>
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#showPassword').click(function(){
                    var passwordInput = $('#password');
                    var fieldType = passwordInput.attr('type');
                    if(fieldType == 'password') {
                        passwordInput.attr('type', 'text');
                    } else {
                        passwordInput.attr('type', 'password');
                    }
                });
            });
        </script>
    </div>
    <?php
    // Gọi trang kết nối
    include('ketnoi.php');
    // Xử lý khi nút "Thêm" được nhấn
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Lấy dữ liệu từ form
        $tendangnhap = $_POST["tendangnhap"];
        $matkhau = $_POST["matkhau"];
        $nhaplaimatkhau = $_POST["nhaplaimatkhau"];
        // Kiểm tra mật khẩu và nhập lại mật khẩu có trùng nhau hay không
        if ($matkhau !== $nhaplaimatkhau) {
            echo "<script>alert('Mật khẩu không trùng khớp!');</script>";
        } elseif (strlen($matkhau) < 6) {
            echo "<script>alert('Mật khẩu phải có ít nhất 6 ký tự!');</script>";
        } else {
            // Tiếp tục xử lý khi mật khẩu nhập lại chính xác và đủ độ dài
            $sql_check = "SELECT * FROM tblthanhvien WHERE TenDangNhap='$tendangnhap'";
            $result_check = $conn->query($sql_check);
            if ($result_check->num_rows > 0) {
                // Nếu tên người dùng đã tồn tại, hiển thị thông báo yêu cầu nhập tên khác
                echo "<script>alert('Tên người dùng đã tồn tại. Vui lòng nhập tên khác!');</script>";
            } else {
                // Nếu tên người dùng chưa tồn tại, tiến hành thêm người dùng vào cơ sở dữ liệu
                $sql_insert = "INSERT INTO tblthanhvien (TenDangNhap, MatKhau) 
                                VALUES ('$tendangnhap', '$matkhau')";
                // Kiểm tra và thực thi câu lệnh
                if ($conn->query($sql_insert) === TRUE) {
                    echo "<script>alert('Tạo tài khoản thành công');</script>";
                    exit();
                } else {
                    echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
                }
            }
        }
    }
    ?>
    <!-- for register popup -->
    <div id="small-dialog1" class="mfp-hide">
        <div class="contact-form1">
            <div class="contact-w3-agileits">
                <h3>Đăng Ký</h3>
                <form action="#" method="post">
                    <div class="form-sub-w3ls">
                        <input placeholder="Tên người dùng hoặc email"  type="text" required="" name="tendangnhap">
                        <div class="icon-agile">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="form-sub-w3ls">
                        <input placeholder="Mật khẩu phải trên 6 kí tự"  type="password" required="" name="matkhau">
                        <div class="icon-agile">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="form-sub-w3ls">
                        <input placeholder="Nhập lại mật khẩu"  type="password" required="" name="nhaplaimatkhau">
                        <div class="icon-agile">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="login-check">
                         <label class="checkbox"><input type="checkbox" name="checkbox" checked="" required="">Tôi chấp nhận Điều khoản & Điều kiện</label>
                    </div>
                    <input type="radio" id="luumatkhau" name="luumatkhau">Lưu mật khẩu

                    <div class="submit-w3l">
                        <input type="submit" name="add" value="Đăng ký">
                    </div>
                </form>
            </div>
        </div>  
    </div>
    <!-- //for register popup -->
    <div class="w3footeragile">
        <p> &copy; 2024 Hieu CNTT-CDKTKT. All Rights Reserved | Code by HieuNguyen </p>
    </div>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
    <!-- pop-up-box-js-file -->  
    <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
    <!--//pop-up-box-js-file -->
    <script>
        $(document).ready(function() {
        $('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });
        });
         $(document).ready(function() {
        $('input[name="add"]').click(function() {
            var tendangnhap = $('input[name="tendangnhap"]').val();
            var matkhau = $('input[name="matkhau"]').val();
            var nhaplaimatkhau = $('input[name="nhaplaimatkhau"]').val();
            var luumatkhau = $('#luumatkhau').prop('checked');
            
            if (luumatkhau) {
                var xacnhan = confirm("Bạn có muốn lưu mật khẩu không?");
                if (xacnhan) {
                    document.cookie = "tendangnhap=" + tendangnhap;
                    document.cookie = "matkhau=" + matkhau;
                }
            }
        });

        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.startsWith("matkhau=")) {
                var matkhau = cookie.substring("matkhau=".length, cookie.length);
                $('input[name="txtpass"]').val(matkhau);
            }
        }
    });
    </script>
</body>
<!-- //Body -->
</html>
