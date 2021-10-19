<?php
session_start();
if(!isset($_SESSION["umail"])){
    header("location:login.php");
    exit;
}

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
    <title>Cats - Block Sites</title>
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
                    <li class="breadcrumb-item active">Categories</li>
                </ol>


                <?php
                if(isset($_GET["id"])){
                    $id=$_GET["id"];

                $sqlc = "SELECT * FROM users WHERE cid='$id'";
                $resultc = mysqli_query($conn, $sqlc);

                if (mysqli_num_rows($resultc) ==0) {

                    $sql = "DELETE FROM cats WHERE id='$id'";

                    if (mysqli_query($conn, $sql)) {


                        $sqld = "DELETE FROM websites WHERE cid='$id'";

                        if (mysqli_query($conn, $sqld)) {

                            $sqle = "DELETE FROM keywords WHERE cid='$id'";

                            if (mysqli_query($conn, $sqle)) {




                        ?>
                        <div class="alert alert-success" role="alert">
                            Category Deleted Successfully!
                        </div>

                        <?php
                            }
                        }
                    }
                }else{
                    //can not delete
                    ?>
                    <div class="alert alert-danger" role="alert">
                        Category Could Not Delete First Delete All users belongs to this category!
                    </div>

                <?php
                }
                }
                ?>
                <a href="catnew.php" class="btn-primary btn">Add New Category</a>
                <br>
                <br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Users
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>

                                <th>Edit</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>

                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM cats";
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {

                                    $id=$row["id"];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['cname'];?></td>




                                        <td><a href="editc.php?id=<?php echo $id;?>">Edit</a></td>
                                        <td><a href="cats.php?id=<?php echo $id;?>">Delete</a></td>

                                    </tr>


                                    <?php
                                }
                            }
                            ?>



                            </tbody>
                        </table>
                    </div>
                </div>


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
