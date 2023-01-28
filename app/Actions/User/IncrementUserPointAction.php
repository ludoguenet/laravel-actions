<?php

declare(strict_types=1);

namespace App\Actions\User;

use _PHPStan_4dd92cd93\Symfony\Component\Console\Exception\LogicException;
use App\Models\User;

final class IncrementUserPointAction
{
    public function execute(
        User $user,
        int $points,
    ): User {
        $user->increment(
            column: 'total_points',
            amount: $points,
        );

        $user->save();

        return $user->refresh();
    }
}
