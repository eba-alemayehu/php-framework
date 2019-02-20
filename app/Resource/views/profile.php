<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
<?php use Application\Framework\Support\Auth; ?>
    <div class="container">
        <div class="row" style="margin-top: 3em">
            <?php if(isset($_GET['success_msg'])):?>
                <div class="alert alert-success">
                    <i><?= $_GET['success_msg'] ?></i>
                </div>
            <?php endif; ?>
            <div class="col-md-8 offset-md-2" style="text-align: center;">
                <div class="card text-center">
                    <img style="width: 150px; height: 150px; border-radius: 50%; align-self: center"
                         src="<?=(Auth::user()->profile_pic == null)?"img/avatar.jpeg":Auth::user()->profile_pic ?>"/>
                    <h3><?=Auth::user()->firstname?> <?=Auth::user()->fathername?> <?=Auth::user()->gfathername?> </h3>
                    <h5 class="text-secondary"><?= Auth::user()->username ?></h5>
                    <p><?= Auth::user()->email ?></p>
                </div>
                <div class="card">
                    <h3>Upload</h3>
                    <form action="profile_pic" method="post" enctype="multipart/form-data">
                        <label for="profile_pic">Upload profile picture</label>
                        <input type="file" accept=".jpeg,.jpg,.png"  class="form-control-file form-control" name="profile_pic" id="profile_pic"/>
                        <button type="submit" class="btn-primary btn float-right mt-5">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>