<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\a5;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function activity($user, $action, $detail, $target, $history)
    {
        $u = new a5;
        $u->user = $user;
        $u->action = $action;
        $u->detail = $detail;
        $u->target = $target;
        $u->history = $history;
        $u->save();
    }
}
