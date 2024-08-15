<?php

namespace App\Http\Controllers;

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
        if ($request->hasFile('file'))
        {
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs(
                'files',
                 $name,
                'public'
            );
        }

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
            'file' => 'file|mimes:png,jpg,pdf'
        ]);

        $application = Application::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null
        ]);

        dispatch(new SendEmailJob($application));

        return redirect()->back();
    }
}
