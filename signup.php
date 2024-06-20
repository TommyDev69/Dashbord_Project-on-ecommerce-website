<?php
include('./db_connection/db_conn.php');
$error = ['fullname' => '', 'username' => '', 'image' => '', 'email' => '', 'gender' => '', 'password' => ''];


if (isset($_POST['submit'])) {
    if (empty($_POST['fullname'])) {
        $error['fullname'] = 'feild is empty';
    } else {
        $fullname = $_POST['fullname'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $fullname)) {

            $error['fullname'] = 'special symbols is not allow except space';
        }
    }

    if (empty($_POST['username'])) {
        $error['username'] = 'feild is empty';
    } else {
        $username = $_POST['username'];
        if (!preg_match('/^[a-zA-Z0-9_-]{3,16}+$/', $username)) {
            $error['username'] = 'must start with alphabet and symbol with no space in between';
        }
    }

    if (empty($_FILES['image']['error'])) {
        $error['image'] = 'field is empty';
    } else {
        $image =  array('image/jpeg', 'image/png', 'image/gif');
        if (isset($_FILES["image"]['type'])) {

            if (!in_array($_FILES['image']['type'], $image)) {
                echo "Error: Only JPG, PNG, and GIF images are allowed.";
                
            }
        }
    }

    if (empty($_POST['email'])) {
        $error['email'] = 'field is empty';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL));
        $error['email'] = 'Invalid email format';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["gender"])) {
            $error['gender'] = " Please select an gender from the field.";
        }
    }
    if (empty($_POST['password'])) {
        $error['password'] = 'field must empty';
    } else {
        $password = $_POST['password'];

        if (!preg_match("/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $error['password'] = 'password must start with uppercase, letter and symbols';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include("./Register_Header/SignupHeader.php") ?>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Sign Up Start -->
        <div class="container-fluid">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">

                <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>LINUX69</h3>
                                </a>
                                <h3>Sign Up</h3>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="fullname" placeholder="enter your name">
                                <div class="text-danger"><?php echo htmlspecialchars($error['fullname']); ?></div>
                            </div>

                            <!-- <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">username</label>
                            </div> -->

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" placeholder="Enter your username">
                                <div class="text-danger"><?php echo htmlspecialchars($error['username']); ?></div>

                            </div>

                            <div class="form-floating mb-3">
                                <input type="file" class="form-control" name="image">
                                <div class="text-danger"><?php echo htmlspecialchars($error['image']); ?></div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" name="email" placeholder="name@example.com">
                                <div class="text-danger"><?php echo htmlspecialchars($error['email']); ?></div>

                            </div>

                            <div class="form-floating mb-3">
                                <select name='gender' class="form-control">
                                    <option value="">Choose your gender</option>
                                    <option value="1">Male</option>
                                    <option value="0">Female</option>
                                </select>
                                <div class="text-danger"><?php echo htmlspecialchars($error['gender']); ?></div>
                            </div>

                            </select>
                            <div class="form-floating mb-4">
                                <input type="password" name='password' class="form-control" placeholder="Password">
                                <div class="text-danger"><?php echo htmlspecialchars($error['password']); ?></div>

                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <a href="">Forgot Password</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name='submit' value="submit">Sign Up</button>
                            <p class="text-center mb-0">Already have an Account? <a href="">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Sign Up End -->
    </div>

    <?php include('./Register_footer/SignUp.footer.php') ?>