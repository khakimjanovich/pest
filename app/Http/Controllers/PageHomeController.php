<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Contracts\View\View;

class PageHomeController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()->whereNotNull('released_at')->get();

        return view('home', compact('courses'));
    }
}