<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="card" style="margin-top: 6em;">
                    <form action="login" method="POST">
                        <h3>Login</h3>
                        <?php if($session->exist("login_err")): ?>
                            <div class="alert alert-danger">
                                <i><?=$session->get("login_err")?></i>
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="username">Worker id</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-round btn-block">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>