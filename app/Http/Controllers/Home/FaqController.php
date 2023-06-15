<?php

namespace App\Http\Controllers\Home;
use App\Models\Faq;
use App\Models\Category;
use App\Http\Controllers\Controller;
class FaqController extends Controller
{
    public function index()
    {
     
        $faqs = Faq::get(['question_'.app()->getLocale() .' as question', 'answer_'.app()->getLocale() .' as answer']);
        return  view('home.faq', compact(['faqs']));
    }
}
