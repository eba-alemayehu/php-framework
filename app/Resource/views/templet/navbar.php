<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Liborary</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#toggle" aria-controls="toggle" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="toggle" style="text-align: right;">

            <ul class="navbar-nav nav mr-auto ml-5 mt-2 mt-lg-0">
                <?php use Application\Framework\Support\Auth;

                if(Auth::user() != null): ?>
                    <a href="dashboard"><li class="mr-3">Home</li></a>
                    <?php if(Auth::User()->role_id == 1): ?>
                        <a href="users"> <li  class="mr-3">Users</li></a>
<!--                        <a href="layborary"> <li  class="mr-3">Liborary</li></a>-->
                        <a href="upload"><li class="mr-3">Upload</li> </a>
                    <?php elseif(Auth::User()->role_id == 2):  ?>
                        <a href="books"><li class="mr-3">Books</li> </a>
                        <a href="upload"><li class="mr-3">Upload</li> </a>
                    <?php elseif(Auth::User()->role_id == 3): ?>
                        <a href="upload"><li class="mr-3">Upload</li> </a>
                    <?php endif; ?>
                <?php endif; ?>

            </ul>

            <ul class="navbar-nav my-2 my-lg-0 float-right">
                <?php if(Auth::user() == null): ?>
                    <a href="login"><li class="nab-item ml-3 mr-3" >Login</li></a>
                    <a href="signup"><li class="nab-item ml-3 mr-3 ">Sign up</li></a>
                <?php else: ?>
                    <div class="dropdown">
                        <span class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton"
                              data-toggle="dropdown"
                        style="background: transparent; border: none">
                            <img style="width: 50px; height: 50px; border-radius: 50%"
                                 src="<?=(Auth::user()->profile_pic == null)?"img/avatar.jpeg":Auth::user()->profile_pic ?>"/>
                        </span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                             style="min-width: 20em;left: -8em;text-align: center;padding: 2em">
                            <img style="width: 150px; height: 150px; border-radius: 50%"
                                 src="<?=(Auth::user()->profile_pic == null)?"img/avatar.jpeg":Auth::user()->profile_pic ?>"/>
                            <h3><?=Auth::user()->firstname?> <?=Auth::user()->firstname?> <?=Auth::user()->firstname?> </h3>
                            <h5 class="text-secondary"><?= Auth::user()->username ?></h5>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <a href="profile"><button class="btn btn-primary "><i class="fa fa-user"></i> Profile</button></a>
                                    </div>
                                    <div class="col">
                                        <a href="logout"><button class="btn btn-default border-dark"><i class="fa fa-sign-out-alt"></i> logout</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </ul>

        </div>
    </div>

</nav>
