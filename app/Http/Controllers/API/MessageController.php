<?php

namespace App\Http\Controllers\API;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageFormRequest;

class MessageController extends Controller
{
    use APIResponse;

    public function store(MessageFormRequest $message)
    {
        // Store only the validated data in the database
        Message::create($message->validated());
        // Redirect the user to a success page
        session()->flash('success', );
        return $this->APIResponse( null , null ,   200  , true  , __('lang.message_sent'));
    }
}
