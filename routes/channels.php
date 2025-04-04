<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('send.message.{contactId}', function () {
    return true;
});