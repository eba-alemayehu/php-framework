<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
    <div class="container">
        <div class="row" style="margin-top: .5em">
            <div class="col-md-8 offset-md-2" >
                <div class="card" style="padding: 2px">
                    <form action="search" method="get">
                        <div class="input-group">
                            <input class="form-control form-control-lg" type="text" name="book_search"
                                   style="border: 0px; box-shadow: none" value="<?=(isset($_GET['book_search']))?$_GET['book_search']:''?>"
                            placeholder="Search Book"/>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <ul class="list-unstyled">
                    <p ><small class="ml-8 text-secondery"><?=count($books)?> search result were found</small></p>
                    <?php if(count($books) == 0): ?>
                    <div class="card text-center">
                        <div class="row">
                            <img src="img/box.svg" style="width: 10em; height: 10em;margin:auto;" />
                        </div>

                        <h3>No results were found</h3>
                    </div>
                    <?php endif; ?>
                    <?php foreach($books as $book): ?>
                        <div class="card mt-2" style="padding: 16px">
                            <a href="book detail?book_id=<?=$book->id?>" style="color: black">
                                <li class="media">
                                    <img src="http://covers.openlibrary.org/b/isbn/<?=$book->isbn?>-M.jpg" alt="book cover page" style="max-height: 100px; max-width: 100px;">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1"><?= $book->title ?></h5>
                                        <small><?= $book->author ?></small>
                                        <?php if($book->softcopy_id != null): ?>
                                            <a href="<?=$book->softcopy->location?>"<p class="float-right"><i class="fa fa-download"></i> Download</p></a>
                                        <?php endif; ?>
                                        <?php if($book->hardcopy != null): ?>
                                            <p class="float-right text-secondary">Fond in hardcoy in <?=ucfirst($book->hardcopy->lib->name)?> liborary shlf <?=$book->hardcopy->shelf?> on floor <?=$book->hardcopy->floor?>  </p>
                                        <?php endif; ?>

                                    </div>
                                </li>
                            </a>
                        </div>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>