<?php include_once(__DIR__."/../templet/header.php"); ?>
<?php include_once(__DIR__."/../templet/navbar.php"); ?>
    <div class="container">
        <div class="row mt-2" >
            <div class="col-md-8 offset-md-2">
                <h3>Rgister</h3>
                <form action="add book" method="post" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col">
                            <label for="lib">Library</label>
                            <select id="lib" name="liborary_id" class="form-control">
                                <?php foreach($liboraries as $lib): ?>
                                    <option value="<?= $lib->id?>"><?= $lib->name?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="floor">Floor</label>
                            <select id="floor" name="floor" class="form-control">
                                <?php for($i = 0; $i < $floor; $i++): ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="shelf">Shelf</label>
                            <input type="text" name="shelf" id="shelf" class="form-control">
                        </div>
                    </div><br>
                    <button class="btn btn-primary float-right mt-3">Register</button>
                </form>
            </div>
        </div>
    </div>
<?php include_once(__DIR__."/../templet/footer.php"); ?>