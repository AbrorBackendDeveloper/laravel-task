<div>
    <div>User: {{ $application->user->name }}</div>
    <div>Id: {{ $application->id }}</div>
    <div>Subject: {{ $application->subject }}</div>
    <div>Message: {{ $application->message }}</div>
    <div>File: <a href="{{ asset($application->file_url) }}"></a></div>
</div>