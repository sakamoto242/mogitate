<?php
namespace App\Http\Controllers;

// 不要になった通常の Request は消しても OK ですが、あっても問題ありません
use Illuminate\Http\Request; 
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }

    // ContactRequest を使うことで、表示前に自動でバリデーションが走ります
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['name', 'email', 'tel', 'content']);
        Contact::create($contact);
        return view('thanks');
    }
}