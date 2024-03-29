<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('comments', function ($user) {
    return $user->id;
});
