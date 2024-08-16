<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Jobs\SendEmailJob;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Mail\ApplicationCreated;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreApplicationRequest;

class ApplicationController extends Controller
{
    public function store(StoreApplicationRequest $request)
    {
        $userId = auth()->id();

        if ($this->hasUserPostedToday($userId)) {
            return back()->with('error', 'Siz bugun faqat bitta post yaratishingiz mumkin.');
        }

        $path = $request->hasFile('file')
            ? $request->file('file')->storeAs('files', $request->file('file')->getClientOriginalName(), 'public')
            : null;

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
