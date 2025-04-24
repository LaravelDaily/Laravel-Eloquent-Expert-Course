<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    public function get_identification_status(Collection $users): array
    {
        // COMMENTED OUT - BAD WAY:
        // $identifiedUsers = 0;
        // $ghostUsers = 0;
        // $others = 0;
        //
        // foreach ($users as $user) {
        //     if ($user->identity == 1) {
        //         $identifiedUsers++;
        //     } elseif ($user->identity == 3) {
        //         $ghostUsers++;
        //     } else $others++;
        // }

        // GOOD WAY:
        $identifiedUsers = User::has('networks')->orWhere(function (Builder $query) {
            $query->whereNotNull('name')->whereNotNull('phone');
        })->count();

        $ghostUsers = User::doesntHave('networks')->has('ghosts')->whereNull('email')->count();

        $others = User::count() - $identifiedUsers - $ghostUsers;

        return [
            'identifiedUsers' => $identifiedUsers,
            'ghostUsers'      => $ghostUsers,
            'others'          => $others,
        ];
    }
}
