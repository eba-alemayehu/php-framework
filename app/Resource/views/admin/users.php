<?php
include(__DIR__."/../templet/header.php");
include(__DIR__."/../templet/navbar.php");
?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2"><br>
                <?php if(isset($_GET['success_msg'])):?>
                    <div class="alert alert-success">
                        <i><?= $_GET['success_msg'] ?></i>
                    </div>
                <?php endif; ?>
                <a href="create user"><button class="btn-lg btn btn-primary float-right m-2">Create user</button></a>
                <h3>Users</h3>

                <table class="table table-striped table-hover">
                    <tr>
                        <td><b>Username</b></td>
                        <td><b>Name</b></td>
                        <td><b>Gender</b></td>
                        <td><b>Email</b></td>
                    </tr>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?=$user->id?></td>
                            <td><?=$user->firstname?> <?=$user->fathername?> <?=$user->gfathername?></td>
                            <td><?=$user->gender?></td>
                            <td><?=$user->email?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
<?php include(__DIR__."/../templet/footer.php");
?>