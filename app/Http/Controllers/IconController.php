<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class IconController extends Controller
{
    public function index()
    {
        $icons = json_decode(Storage::get('fa-free-icons.json'), true);

        return view('icons.index', compact('icons'));
    }
}
