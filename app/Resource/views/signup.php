<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
    <div class="container">
        <div class="row" style="margin-top: 1em">
            <div class="col-md-8 offset-md-2"">
                <div class="card">
                    <h3>Sign up</h3>
                    <?php if(isset($_GET['err_msg'])):?>
                        <div class="alert alert-danger">
                            <i><?= $_GET['err_msg'] ?></i>
                        </div>
                    <?php endif; ?>
                    <form action="signup" method="POST">
                        <div class="form-group ">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="firstname">Frist name</label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="fathername">Father name</label>
                                    <input type="text" name="fathername" id="fathername" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="gfathername">Grand Father name</label>
                                    <input type="text" name="gfathername" id="gfathername" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" min="6" name="password" id="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="confirm_password">Confirm password</label>
                                    <input type="password"  min="6" name="confirm_password" id="confirm_password" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>