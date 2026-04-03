<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        return view('guest.home');
    }

    public function faq()
    {
        return view('guest.faq');
    }

    public function announcements()
    {
        return view('guest.announcements');
    }

    public function scholarshipPrograms()
    {
        return view('guest.programs');
    }
}
