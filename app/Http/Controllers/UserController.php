<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryUser;
use Config;
use Illuminate\Support\Facades\Validator;
use Log;

class UserController extends Controller
{
    //
    public function index()
    {
        try {

            $pageSize = Config::get('settings.paginate');

            $libUsers = LibraryUser::paginate($pageSize);

            return view('users.index', compact('libUsers'));

        } catch (Exception $e) {

            Log::error('UserController index exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function create()
    {
        try {

            return view('users.create');

        } catch (Exception $e) {

            Log::error('UserController create exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'nic' => 'required|string|max:50',

            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $storeUser = new LibraryUser;
                $storeUser->name = $request->name;
                $storeUser->phone_number = $request->phone;
                $storeUser->address = $request->address;
                $storeUser->NIC = $request->nic;

                $storeUser->save();

                return back()->with('status', 'User saved successfully');
            }

        } catch (Exception $e) {

            Log::error('UserController store exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function edit($id)
    {
        try {

            $user = LibraryUser::find($id);

            return view('users.edit', compact('user'));

        } catch (Exception $e) {

            Log::error('UserController edit exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }

    }

    public function update(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'nic' => 'required|string|max:50',

            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $storeUser = LibraryUser::find($id);
                $storeUser->name = $request->name;
                $storeUser->phone_number = $request->phone;
                $storeUser->address = $request->address;
                $storeUser->NIC = $request->nic;


                $storeUser->save();

                return back()->with('status', 'User update successfully');
            }

        } catch (Exception $e) {
            Log::error('BookController update exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }
    }

    public function destroy($id)
    {
        try {

            LibraryUser::find($id)->delete();

            return back()->with('status', 'User deleted');

        } catch (Exception $e) {

            Log::error('UserController destroy exception: '.$e->getMessage() . ' in line '. $e->getLine());

            return back()->with('danger', 'An Unexpected Error Occurred');
        }

    }

}
