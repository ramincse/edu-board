<?php include_once "templates/header.php"; ?>
<?php 
    use Edu\Board\Controller\User;

    $usr = new User;
?>
<!-- MAIN CONTENT  -->
<section id="content">
    <section class="hbox stretch">
        <section>
            <section class="vbox">
                <section class="scrollable padder">

                    <section class="row m-b-md">
                        <div class="col-sm-6">
                            <h3 class="m-b-xs text-black">All Results</h3> <small>Welcome back, <?php echo $_SESSION['name']; ?>, <i class="fa fa-map-marker fa-lg text-primary"></i><?php echo $_SESSION['email']; ?></small>
                        </div>
                        <!-- <div class="col-sm-6 text-right text-left-xs m-t-md">
                            <div class="btn-group">
                                <a class="btn btn-rounded btn-default b-2x dropdown-toggle" data-toggle="dropdown">Widgets <span class="caret"></span></a>
                                <ul class="dropdown-menu text-left pull-right">
                                    <li><a href="#">Notification</a></li>
                                    <li><a href="#">Messages</a></li>
                                    <li><a href="#">Analysis</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">More settings</a></li>
                                </ul>  
                            </div> 
                        </div>  -->                                        
                    </section>

                <!-- = = = = = = = = = Our Page Content = = = = = = = = = -->
<!-- = = = = = = = = = Add new user Modal = = = = = = = = = --> 
<div id="add_result_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- <div class="modal-header"></div> -->
            <div class="modal-body">
                <h2>Add result</h2>
                <div class="mess"></div>
                <hr>
                <form id="add_student_form" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Search student</label>
                        <input id="search_student" name="search" class="form-control" type="text">
                        <div class="stu_reg"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Bangla</label>
                        <input name="email" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">English</label>
                        <input name="cell" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Math</label>
                        <input name="cell" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Social Science</label>
                        <input name="email" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Science</label>
                        <input name="cell" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <input name="cell" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <input name="submit" class="btn btn-sm btn-primary" type="submit" value="Add result">
                    </div>
                </form>
            </div>
            <!-- <div class="modal-footer"></div> -->
        </div>
    </div>
</div>              
<!-- = = = = = = = = = All Users = = = = = = = = = -->               
<div class="row">
    <div class="col-sm-12">
        <a id="add_result_btn" class="btn btn-sm btn-primary" href="">Add student result</a>
        <br>
        <br>
        <section class="panel panel-default">
            <header class="panel-heading"><span class="label bg-danger pull-right m-t-xs">4 left</span>All results</header>
            <table class="table table-striped m-b-none">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Cell</th>
                        <th>Role</th>
                        <th>photo</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ruhul</td>
                        <td>ruhul@gmail.com</td>
                        <td>99999</td>
                        <td>Admin</td>
                        <td>
                            <img style="width: 50px; height: 50px; display: block;" src="images/avatar.jpg" alt="">
                        </td>
                        <td>Active</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="">View</a>
                            <a class="btn btn-sm btn-warning" href="">Edit</a>
                            <a class="btn btn-sm btn-danger" href="">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>


                </section>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
</section>
<?php include_once "templates/footer.php"; ?>