<?php

namespace App\Http\Controllers;

use App\Models\BookBorrowalData;
use Exception;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Book_Cate;
use App\Models\LibraryUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Config;
use Log;
class BookController extends Controller
{
    public function index(Request $request)
    {
        try {

            $pageSize = Config::get('settings.paginate');

            $categories = Book_Cate::all();

            $categoryId = 0;
            $books = Book::with('bookCategory');
            if (isset($request->category_id) && $request->category_id != 0) {

                $categoryId = $request->category_id;
                $books->where('book_category_id', $categoryId);

            }

                $books = $books->paginate($pageSize);



            return view('books.index', compact('books', 'categories', 'categoryId'));

        } catch (Exception $e) {

            Log::error('BookController index exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function create()
    {
        try {

            $categories = Book_Cate::all();

            return view('books.create', compact('categories'));

        } catch (Exception $e) {

            Log::error('BookController create exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'category_id' => 'required|exists:book_cate,id',

            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $storeBook = new Book;
                $storeBook->title = $request->title;
                $storeBook->author = $request->author;
                $storeBook->price = $request->price;
                $storeBook->stock = $request->stock;
                $storeBook->book_category_id = $request->category_id;

                $storeBook->save();

                return back()->with('status', 'Book saved successfully');
            }

        } catch (Exception $e) {

            Log::error('BookController store exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function edit($id)
    {
        try {

            $book = Book::where('id', $id)->first();

            $categories = Book_Cate::all();

            return view('books.edit', compact('book', 'categories'));

        } catch (Exception $e) {

            Log::error('BookController edit exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }

    }

    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'category_id' => 'required|exists:book_cate,id',

            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $updateBook = Book::find($id);
                $updateBook->title = $request->title;
                $updateBook->author = $request->author;
                $updateBook->price = $request->price;
                $updateBook->stock = $request->stock;
                $updateBook->book_category_id = $request->category_id;

                $updateBook->save();

                return redirect('/book')->with('status', 'Book update successfully');
            }

        } catch (Exception $e) {

            Log::error('BookController update exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function destroy($id)
    {
        try {

            Book::find($id)->delete();

            return back()->with('status', 'Book deleted');

        } catch (Exception $e) {

            Log::error('BookController destroy exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }

    }

    public function issueBook()
    {
        try {

            $books = Book::all();

            $users = LibraryUser::all();

            return view('issue_books.create', compact('books', 'users'));

        } catch (Exception $e) {
            Log::error('BookController issueBook exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function storeIssuedDetails(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:library_users,id',
                'book_id' => 'required|exists:books,id',
                'period' => 'required|integer',
                'borrowal_date' => 'required|date',

            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $bookId = $request->book_id;

                $checkBookAvailability = Book::find($bookId);
                $booksStockCount = $checkBookAvailability->stock;

                if ($booksStockCount > 0) {

                    $storeIssuedDetails = new BookBorrowalData;
                    $storeIssuedDetails->user_id = $request->user_id;
                    $storeIssuedDetails->book_id = $bookId;
                    $storeIssuedDetails->days_count = $request->period;
                    $storeIssuedDetails->borrowal_date = $request->borrowal_date;

                    if ($storeIssuedDetails->save()) {

                        $bookId = $request->book_id;
                        $bookCount = 1;

                        $this->stockMange($bookId, $bookCount);

                    }

                    return back()->with('status', 'Borrowal details saved successfully');

                } else {
                    return back()->with('warning', $checkBookAvailability->title . ' book is out of stock');
                }

            }



        } catch (Exception $e) {

            Log::error('BookController storeIssuedDetails exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function issuedBookList()
    {
        try {
            $pageSize = Config::get('settings.paginate');
            $bookList = BookBorrowalData::with('books', 'libUsers')->paginate($pageSize);

            return view('issue_books.index', compact('bookList'));

        } catch (Exception $e) {

            Log::error('BookController issuedBookList exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function borrowalDetailsEdit($id)
    {

        try {

            $borrowal = BookBorrowalData::find($id);

            $books = Book::all();

            $libUsers = LibraryUser::all();

            return view('issue_books.edit', compact('borrowal', 'books', 'libUsers'));

        } catch (Exception $e) {

            Log::error('BookController borrowalDetailsEdit exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function borrowalDetailsUpdate(Request $request, $id)
    {

        try {

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:library_users,id',
                'book_id' => 'required|exists:books,id',
                'period' => 'required|integer',
                'borrowal_date' => 'required|date',

            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $updateBorrowalDetails = BookBorrowalData::find($id);
                $updateBorrowalDetails->user_id = $request->user_id;
                $updateBorrowalDetails->book_id = $request->book_id;
                $updateBorrowalDetails->days_count = $request->period;
                $updateBorrowalDetails->borrowal_date = $request->borrowal_date;

                $updateBorrowalDetails->save();

                return back()->with('status', 'Borrowal details update successfully');

            }

        } catch (Exception $e) {

            Log::error('BookController borrowalDetailsUpdate exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function borrowalBookReturn($id)
    {

        try {

            $date = Carbon::now()->format('Y-m-d');

            $updatereturnDate = BookBorrowalData::find($id);
            $updatereturnDate->return_date = $date;


            if ($updatereturnDate->save()) {

                $bookId = $updatereturnDate->book_id;
                $bookCount = -1;
                $this->stockMange($bookId, $bookCount);
            }

            return back()->with('status', 'Book return data update successfully');

        } catch (Exception $e) {

            Log::error('BookController borrowalBookReturn exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function stockMange($bookId, $bookCount)
    {

        try {

            $bookDetail = Book::find($bookId);

            $currentStock = $bookDetail->stock;

            $newStock = $currentStock - $bookCount;

            $bookDetail->stock = $newStock;
            $bookDetail->save();

            return true;

        } catch (Exception $e) {

            Log::error('BookController stockMange exception: '.$e->getMessage() . ' in line '. $e->getLine());

            throw $e;
        }
    }
}
