<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ValidatePostController extends Controller
{
    public function __invoke(
        Request $request,
        Post $post,
    ): RedirectResponse {
        // Validate post

        // Send Email
    }
}
