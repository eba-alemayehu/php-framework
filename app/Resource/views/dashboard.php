<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
    <div class="container">
        <div class="row" style="margin-top: 8em">
            <div class="col-md-8 offset-md-2" style="text-align: center;">
                <h2>Search books</h2>
                <div class="card" style="padding: 2px; margin-top: 2em">
                    <form action="search" method="get">
                        <div class="input-group">
                            <input class="form-control form-control-lg" type="text" name="book_search"
                                   style="border: 0px; box-shadow: none"/>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>