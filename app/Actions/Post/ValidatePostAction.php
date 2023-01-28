<?php

declare(strict_types=1);

namespace App\Actions\Post;

use App\Actions\User\IncrementUserPointAction;
use App\Enums\PostStatusEnum;
use App\Mail\PostValidatedMail;
use App\Models\Post;
use http\Exception\RuntimeException;
use Illuminate\Support\Facades\Mail;

final class ValidatePostAction
{
    public function __invoke(
        Post $post,
    ): void {
        if ($post->status === PostStatusEnum::VALIDATED) {
            return;
        }

        $post->status = PostStatusEnum::VALIDATED;
        $post->save();

        if ($post->user === null) {
            throw new RuntimeException('A post must belong to a user');
        }

        app(abstract: IncrementUserPointAction::class)
            ->execute(
                user: $post->user,
                points: 10,
            );

        Mail::to($post->user)
            ->send(
                mailable: new PostValidatedMail(
                    post: $post->refresh(),
                ),
            );
    }
}
