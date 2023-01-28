<?php

declare(strict_types=1);

namespace App\Http\Controllers\Post;

use App\DataObjects\Post\PostDataObject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;

class StorePostController extends Controller
{
    public function __invoke(
        StorePostRequest $request,
    ): void {
        PostDataObject::make(
            request: $request,
        );
    }
}
