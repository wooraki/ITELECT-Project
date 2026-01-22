<?php
    session_start();


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = trim($_POST['username']);
        $password =  trim($_POST['password']);

        $username = htmlspecialchars(string: $username);
        $password = htmlspecialchars(string: $password);

        $staticUname = "mubaraksxcz";
        $staticPass = "raki122002";

        if($username === $staticUname && $password === $staticPass){
            $_SESSION['username'] = $staticUname;

            header("Location: index.php");
            exit();
        }else{
            $error = "Invalid username and password";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-secondary" style="background-image: url('bg.jpg');
                        background-size: cover;
                        background-position: center;
                        background-repeat: no-repeat;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">                
                <main>                   
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="login.php">

                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="username" type="text" placeholder="Username" required autofocus/>
                                                <label>Username</label>
                                            </div>

                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" type="password" placeholder="Password" required autofocus/>
                                                <label>Password</label>
                                            </div>

                                            <div class="d-grid">
                                                <button class="btn btn-primary" href="login.php">Login</button>
                                            </div>
                                            <?php
                                                if(isset($error)) echo
                                                "<p class='text-danger mt-4'>$error</p>";
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <?php
                    include("footer.php")
                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
