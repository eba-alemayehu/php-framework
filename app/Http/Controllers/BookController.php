<?php 

namespace App\Http\Controllers;

use App\Book;
use App\Book_liborary;
use App\Book_softcopy;
use App\Catagory;
use App\Liborary;
use App\Rate;
use Application\Framework\Support\Auth;
use Application\Framework\Support\View;
use Application\Framework\Foundation\Request;
use Application\Framework\Support\Response;

class BookController{
    /**
     *
     */
    public function index(){
        $book = new Book();
        $books = $book->orderBy("created_at", "DESC")->get();
        $c = new Catagory();
        foreach($books as $book){
            $book->catagory = $c->find($book->catagory_id);
        }

        $user = new \App\User();
        $u = $user->find($_SESSION['id']);
        $user = null;

        return View::view("encoder/books_list")->with("books", $books)->with("auth", $u);
    }

    public function addBook(){
        $catagories = new Catagory();
        $library = new Liborary();

        return View::view("encoder/register_book")
            ->with("catagories", $catagories->get())
            ->with("liboraries", $library->get())
            ->with("floor", 4);
    }
    public function register(){
        $book = new Book();
        $hard_copy = new Book_liborary();
        $_REQUEST['hardcopy'] = 1;
        $inserted_book = $book->insert(Request::allExcept(["liborary_id", "floor", "shelf"]));

        $_REQUEST['liborary_id'] = $inserted_book->id;
        $_REQUEST['book_id'] = $inserted_book->id;
        $insert_hard_copy = $hard_copy->insert(Request::allExcept(["title", "isbn", "catagory_id",'hardcopy',"author"]));

        Response::redirect("books?success_msg=You have successfuly registered <b>".
            $inserted_book->title);
    }

    public function search(){
        $key= $_REQUEST['book_search'];
        $book = new Book();
        $search_results = $book->search($key);

        foreach($search_results as $book){

            if($book->softcopy_id != null){
                $softcopy =new Book_softcopy();
                $book->softcopy = $softcopy->find($book->softcopy_id);
            }else{ $book->softcopy = null; }

            if($book->hardcopy != null){
                $hardcopy = new Book_liborary();
                $book->hardcopy = $hardcopy->find($book->id);
                $lib = new Liborary();
                $book->hardcopy->lib = $lib->find($book->hardcopy->id);
            }else{ $book->hardcopy = null; }
        }
//        return $search_results;
        return View::view("search")->with("books", $search_results);
    }

    public function detail(){
        $book_id= $_GET['book_id'];
        $book = new Book();
        $rate = new Rate();
        $book_rating = count($rate->where("book_id",$book_id)->get());
        $book = $book->find($book_id);
        if($book->softcopy_id != null){
            $softcopy =new Book_softcopy();
            $book->softcopy = $softcopy->find($book->softcopy_id);
        }else{ $book->softcopy = null; }

        if($book->hardcopy != null){
            $hardcopy = new Book_liborary();
            $book->hardcopy = $hardcopy->find($book->id);
            $lib = new Liborary();
            $book->hardcopy->lib = $lib->find($book->hardcopy->id);
        }else{ $book->hardcopy = null; }
        return View::view("book detail")->with("book", $book)->with("rating", $book_rating);
    }

    public function rate(){
        $book_id = $_GET['book_id'];

        $rate = new Rate();
        if(count($rate->where("book_id", $book_id)->where("user_id",Auth::id())->get()) == 0){
            $rate->insert([
                "book_id" => $book_id,
                "user_id" => Auth::id(),
                "rate" => 1
            ]);
        }


        Response::redirect("book detail?book_id=".$book_id);
    }
}