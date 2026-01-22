<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

//static data
if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [
        1 => ['fullname' => 'ESCOSIO', 'course' => 'BSIT'],
        2 => ['fullname' => 'JARAMILLO', 'course' => 'BSN'],
        3 => ['fullname' => 'DISO', 'course' => 'BSTM'],
        4 => ['fullname' => 'MARINEZ', 'course' => 'BSHM'],
        5 => ['fullname' => 'GAMUZARAN', 'course' => 'BEED'],
        6 => ['fullname' => 'GAMUZARAN', 'course' => 'BEED']
    ];
}


//add & update
if (isset($_POST['save'])) {
    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $id = $_POST['id'];

    if ($id == "") {
        $newId = count($_SESSION['students']) > 0
            ? max(array_keys($_SESSION['students'])) + 1
            : 1;

        $_SESSION['students'][$newId] = [
            'fullname' => $fullname,
            'course' => $course
        ];
    } else {
        $_SESSION['students'][$id] = [
            'fullname' => $fullname,
            'course' => $course
        ];
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    if (isset($_SESSION['students'][$id])) {
        unset($_SESSION['students'][$id]);
    }
    $_SESSION['success'] = "Student record Deleted Successfully!";
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
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
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php
    include("topnav.php")
        ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php
            include("sidenav.php")
                ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary d-flex ms-auto" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <span><i class="fa-solid fa-plus"> </i></span> Add Po
                    </button>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px; background-color: #0c63e4; color: white;">ID</th>
                                    <th style="background-color: #0c63e4; color: white;">Full Name</th>
                                    <th style="background-color: #0c63e4; color: white;">Course</th>
                                    <th style="width: 150px; background-color: #0c63e4; color: white;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['students'] as $id => $student): ?>
                                    <tr>
                                        <td><?= $id ?></td>
                                        <td><?= htmlspecialchars($student['fullname']) ?></td>
                                        <td><?= htmlspecialchars($student['course']) ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(<?= $id ?>)">
                                            <i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Entry Po</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <input type="hidden" name="id" value="">
                                    <div class="row">
                                        <div class="mb-2 w-50">
                                            <input type="text" name="fullname" class="form-control"
                                                placeholder="Full name" required>
                                        </div>
                                        <div class="mb-2 w-50">
                                            <input type="text" name="course" class="form-control" placeholder="Course"
                                                required>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button name="save" class="btn btn-success">Save Po</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include("footer.php")
                ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id){
            Swal.fire({
                title: 'Are u sure naba talaga to delete this po?',
                text: "This record will be permanently deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",   
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "?delete=" + id;
                }
            });
        }
    </script>
</body>

</html>