<?php
session_start();
if(!isset($_SESSION["umail"])){
    header("location:login.php");
    exit;
}
if(!isset($_GET["id"])){
    header("location:users.php");
    exit;
}
$uid=$_GET["id"];

include ("../conn.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Edit Keyword - Block Sites</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">Block Sites Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link" href="cats.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                        Categories
                    </a>

                    <a class="nav-link" href="keywords.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                        Keywords
                    </a>


                    <a class="nav-link" href="websites.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-list-alt"></i></div>
                        Websites
                    </a>

                    <a class="nav-link" href="users.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Users
                    </a>





                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?php echo $_SESSION["umail"]; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Edit Keyword</li>
                </ol>


                <?php
                if(isset($_POST["link"])){
                    $link=$_POST["link"];

                    $cid=$_POST["cid"];

                    $sql = "UPDATE keywords SET link='$link', cid='$cid' WHERE id='$uid'";
                    if (mysqli_query($conn, $sql)) {
                        ?>
                        <div class="alert alert-success" role="alert">
                            Keyword Updated Successfully!
                        </div>

                        <?php
                    }
                }

                ?>
                <br>
                <br>
                <?php


                $userSql="SELECT * FROM keywords WHERE id='$uid'";
                $resultuser = mysqli_query($conn, $userSql);

                if (mysqli_num_rows($resultuser) > 0) {
// output data of each row
                    while($rowuser = mysqli_fetch_assoc($resultuser)) {

                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Edit Keyword
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-6 mx-auto">
                                        <form method="post" action="">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="link"  name="link" value="<?php echo $rowuser['link'];?>" placeholder="keyword">
                                                <label for="link">Keyword</label>
                                            </div>


                                            <div class="form-floating mb-3">
                                                <select class="form-control" name="cid">
                                                    <?php
                                                    $sql1="SELECT * FROM cats";
                                                    $result1 = mysqli_query($conn, $sql1);

                                                    if (mysqli_num_rows($result1) > 0) {
                                                        // output data of each row
                                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                                            ?>
                                                            <option <?php if($rowuser['cid']==$row1['id']){echo 'selected';}?> value="<?php echo $row1['id'];?>"><?php echo $row1['cname'];?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="cid">Select Category</label>
                                            </div>




                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                                <button type="submit" class="btn btn-primary" >Update Keyword</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>



                            </div>
                        </div>
                        <?php
                    }}
                ?>

            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>

                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>
</html>
