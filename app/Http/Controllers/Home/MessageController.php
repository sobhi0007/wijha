<?php

namespace App\Http\Controllers\Home;
use App\Models\Message;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageFormRequest;

class MessageController extends Controller
{
    public function index()
    {
        $lang =app()->getLocale();
        $categories = Category::get(['name_'.app()->getLocale() .' as name', 'slug']);
        return  view('home.message', compact(['categories']));
    }

    public function store(MessageFormRequest $message)
    {
        // Store only the validated data in the database
        Message::create($message->validated());
        // Redirect the user to a success page
        session()->flash('success', __('lang.message_sent'));
        return redirect()->back();
    }
}
