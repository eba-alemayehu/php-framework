<?php 

namespace App\Http\Controllers;

use App\Book;
use App\Book_softcopy;
use App\Catagory;
use App\Liborary;
use Application\Framework\Foundation\Request;
use Application\Framework\Support\Auth;
use Application\Framework\Support\File;
use Application\Framework\Support\View;
use http\Env\Response;

class UploadController{
    /**
     * @return mixed
     */
    public function index(){
        $catagories = new Catagory();
        $library = new Liborary();

        return  View::view("upload")
            ->with("catagories", $catagories->get())
            ->with("liboraries", $library->get());
    }

    public function upload(){
        $book = new Book();
        $book_insert = $book->insert(Request::all());

        $file =  File::store("book", "book/", $book_insert->title."-".md5($book_insert->id));
        $_REQUEST["location"] =$file->relative_path_file;
        $_REQUEST["size"] =$file->size;
        $_REQUEST["book_id"] = $book_insert->id;
        $_REQUEST["user_id"] = Auth::id();

        $book_soft = new Book_softcopy();
        $book_soft_insert = $book_soft->insert(Request::allExcept(["title", "isbn", "catagory_id", "author", "softcopy_id"]));

        $book->where("id", $book_insert->id)->update(["softcopy_id"=>$book_soft_insert->id]);

        \Application\Framework\Support\Response::redirect("books?success_msg=You have successfuly uploaded ".$book_insert->title);
    }
}