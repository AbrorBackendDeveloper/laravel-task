<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Jobs\SendEmailJob;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Mail\ApplicationCreated;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $userId = auth()->id;

        if ($this->hasUserPostedToday($userId)) {
            return back()->with('error', 'Siz bugun faqat bitta post yaratishingiz mumkin.');
        }

        $path = $request->hasFile('file')
            ? $request->file('file')->storeAs('files', $request->file('file')->getClientOriginalName(), 'public')
            : null;

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
            'file' => 'file|mimes:png,jpg,pdf'
        ]);

        $application = Application::create([
            'user_id' => $userId,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path,
        ]);

        dispatch(new SendEmailJob($application));

        return redirect()->back();
    }

    protected function hasUserPostedToday($userId)
    {
        return Application::where('user_id', $userId)
            ->whereDate('created_at', Carbon::today())
            ->exists();
    }
}
