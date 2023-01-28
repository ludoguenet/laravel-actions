<?php

declare(strict_types=1);

use App\Actions\Post\ValidatePostAction;
use App\Enums\PostStatusEnum;
use App\Models\Post;

it('validates a post', function () {
    \Illuminate\Support\Facades\Mail::fake();
    $post = Post::factory()->create();

    (new ValidatePostAction)(
        post: $post,
    );

    \Illuminate\Support\Facades\Mail::assertSent(\App\Mail\PostValidatedMail::class);

    expect($post->status)->toEqual(PostStatusEnum::VALIDATED);
    expect($post->user->total_points)->toEqual(10);
});
