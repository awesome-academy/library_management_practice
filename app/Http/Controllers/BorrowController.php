<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class BorrowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $take = config('setting.paginate');
        $listborrow = Borrow::where('id_user', '=' , Auth::user()->id)->orderBy('id', 'ASC')->paginate($take);

        return view('borrows.list_borrow', compact('listborrow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function contact()
    {
        return view('borrows.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('borrows.show', compact('book'));
    }

    public function confirm(Request $req, $id)
    {
        $date_pay = strtotime($req['date_pay']);
        $date_borrow = strtotime(date("Y-m-d"));

        if ($date_pay >= $date_borrow) {
            $borrow = [
                'date_pay' => $req['date_pay'],
                'accept' => Borrow::WAITING,
                'id_user' => auth()->user()->id,
                'id_book' => $id,
            ];
            Borrow::create($borrow);

            $admins = User::where('role', '=', 1)->pluck('email');
            Mail::send('borrows.user_borrow',[
            ], function($mail) use ($admins)
            {
                $mail->to($admins[0])->cc($admins[1]) ;
                $mail->from('v.phuc021@gmail.com');
                $mail->subject('You have a borrow request');
            });

            return redirect()->back()->with(['borrow-success' => trans('borrows/borrow.success_wait')]);
        }

        return redirect()->back()->with(['borrow-error' => trans('borrows/borrow.erro_date_value')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $borrow = Borrow::findOrFail($id);
            $borrow->destroy($id);

            return redirect()->back()->with(['deleteSuccess' => 'success']);
        } catch (ModelNotFoundException $e) {
            throw new Exception($e->getMesseage());
        }
    }
}
