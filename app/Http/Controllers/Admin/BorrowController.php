<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\User;
use App\Models\Book;
use Mail;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function index()
    {
        $take = config('setting.paginate');
        $listborrow = Borrow::orderBy('id', 'DESC')->paginate($take);
        return view('admin.borrows.list_borrow', compact('listborrow'));
    }

    public function action($id, $status)
    {
        $borrow['accept'] = $status;
        Borrow::where('id', '=', $id)->update($borrow);
    }

    public function accept($id)
    {
        $borrow = Borrow::findOrFail($id);
        $email = $borrow->user->email;
        $status = Borrow::BORROWING;
        $this->action($id, $status);

        Mail::send('borrows.admin_accept',[
            ], function($mail) use ($email)
            {
                $mail->to($email);
                $mail->from('v.phuc021@gmail.com');
                $mail->subject('Request Borrow Accept');
            });

        return redirect()->back();
    }

    public function deny($id)
    {
        $borrow = Borrow::findOrFail($id);
        $email = $borrow->user->email;
        $status = Borrow::DECLINED;
        $this->action($id, $status);

        Mail::send('borrows.admin_deny',[
            ], function($mail) use ($email)
            {
                $mail->to($email);
                $mail->from('v.phuc021@gmail.com');
                $mail->subject('Request Borrow Deny');
            });

        return redirect()->back();
    }

    public function pay($id)
    {
        $status = Borrow::RETURN;
        $this->action($id, $status);

        return redirect()->back();
    }

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
