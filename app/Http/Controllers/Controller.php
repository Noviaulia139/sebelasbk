<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Base Controller (induk dari semua controller di project)
class Controller extends BaseController
{
    // Trait yang dipakai untuk:
    // - AuthorizesRequests → otorisasi (izin akses)
    // - DispatchesJobs → menjalankan job/queue
    // - ValidatesRequests → validasi request (yang sering kamu pakai)
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}