<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <h3>Upload</h3>
                    <?php if(isset($_GET['success_msg'])):?>
                        <div class="alert alert-success">
                            <i><?= $_GET['success_msg'] ?></i>
                        </div>
                    <?php endif; ?>
                    <form action="upload" method="post" enctype="multipart/form-data" class="mt-3">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" name="isbn" id="isbn" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="catagory">Catagory</label>
                                    <select name="catagory_id" id="catagory" class="form-control">
                                        <?php foreach($catagories as $catagory): ?>
                                            <option value="<?= $catagory->id?>"><?= $catagory->name?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" id="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="book">Book</label>
                            <input type="file" accept=".pdf" name="book" id="book" class="form-control form-control-file">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary float-right mt-3"><i class="fa fa-upload"></i> Upload</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>