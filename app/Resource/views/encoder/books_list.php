<?php include_once(__DIR__."/../templet/header.php"); ?>
<?php include_once(__DIR__."/../templet/navbar.php"); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-3 offset-9">
                        <a href="add book"><button class="btn btn-lg btn-primary float-right mt-3 mb-2"><i class="fa fa-plus"></i> Add Book</button></a>
                    </div>
                </div>
                <?php if(isset($_GET['success_msg'])):?>
                    <div class="alert alert-success">
                        <i><?= $_GET['success_msg'] ?></i>
                    </div>
                <?php endif; ?>
                <?php if($books == null): ?>
                <div class="card">
                    <h1 style="text-align: center">No books are registerd</h1>
                </div>
                <?php else: ?>
                    <table class="table table-striped table-hover">
                        <tr >
                            <td><b>Title</b></td>
                            <td><b>Isbn</b></td>
                            <td><b>Catagory</b></td>
                            <td><b>Author</b></td>
                            <td><b>Softcopy</b></td>
                            <td><b>Hardcopy</b></td>
                        </tr>
                        <?php foreach($books as $book): ?>
                            <a href="book detail?book_id=<?=$book->id?>" style="color: black">
                            <tr onclick="window.location.href='book detail?book_id=<?=$book->id?>'">
                            <td><?=$book->title?></td>
                            <td><?=$book->isbn?></td>
                            <td><?=$book->catagory->name?></td>
                            <td><?=$book->author?></td>
                                <td><?=($book->softcopy_id)?"<i class='fa fa-check' style='color:green'></i>":""?></td>
                                <td><?=($book->hardcopy)?"<i class='fa fa-check' style='color:green'></i>":""?></td>
                            </tr>
                            </a>
                        <?php endforeach; ?>
                    </table>

                <?php endif; ?>
                <table>

                </table>
            </div>
        </div>
    </div>
<?php include_once(__DIR__."/../templet/footer.php"); ?>