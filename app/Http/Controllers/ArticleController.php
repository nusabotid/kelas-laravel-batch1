<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $sort = request('sort');

        return 'Halaman Article ' . $sort;
    }

    public function show($slug) {
        return 'Halaman Detail Article ' . $slug;
    }
}
