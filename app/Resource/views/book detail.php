<?php include_once("templet/header.php"); ?>
<?php include_once("templet/navbar.php"); ?>
<?php use Application\Framework\Support\Auth; ?>
    <div class="container" xmlns="http://www.w3.org/1999/html">
        <div class="row" style="margin-top: 2em">
            <div class="col-md-8 offset-md-2" style="text-align: center;">
                <div class="card text-center">
                    <img class="mr-3 ml-6" src="http://covers.openlibrary.org/b/isbn/<?=$book->isbn?>-M.jpg" alt="book cover page" style="max-height: 300px; max-width: 300px; align-self: center">
                    <h2 class="mt-5"><?=ucfirst($book->title)?></h2>
                    <?php if($book->softcopy_id != null): ?>
                    <a href="<?=$book->softcopy->location?>"> <button class="btn btn-outline-dark"><i class="fa fa-download"></i> Download</button> </a>
                    <?php endif; ?>
                    <?php if($book->hardcopy != null): ?>
                        <p class="text-secondary">Fond in hardcoy in <?=ucfirst($book->hardcopy->lib->name)?> liborary shlf <?=$book->hardcopy->shelf?> on floor <?=$book->hardcopy->floor?>  </p>
                    <?php endif; ?>
                    <div class="row">
                        <a href="rate?book_id=<?=$book->id?>"<button class="btn-primary btn float-right"><i class="fa fa-like"> Rate ( <?=$rating?> )</i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once("templet/footer.php"); ?>