<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Employee;
use App\Models\Customer;

class AccountsController extends Controller
{
    public function __contruct()
    {
        $this->middleware('employee')->except('logout');
    }

    public function accountIndex()
    {
        $employees = Employee::all(); // Fetch all accounts from the database

        $customers = Customer::all();

        return view('employees.accounts', compact('employees', 'customers'));
    }

    public function create()
    {
        return view('accounts.create');
    }

}
