<?php

declare(strict_types=1);

use App\Actions\Post\ValidatePostAction;
use App\Enums\PostStatusEnum;
use App\Mail\PostValidatedMail;
use App\Models\Post;

it('validates a post', function () {
    \Illuminate\Support\Facades\Mail::fake();
    $post = Post::factory()->create([
        'status' => PostStatusEnum::DRAFT,
    ]);

    (new ValidatePostAction)(
        post: $post,
    );

    \Illuminate\Support\Facades\Mail::assertSent(PostValidatedMail::class);

    expect($post->status)->toEqual(PostStatusEnum::VALIDATED);
    expect($post->user->total_points)->toEqual(10);
});
