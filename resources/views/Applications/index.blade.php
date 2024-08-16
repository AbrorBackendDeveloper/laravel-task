<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                        <span class="text-blue-500 font-bold text-xl">My Applications</span>

                        <!-- This is an example component -->
                        <div class='mt-5'>
                            @foreach ($applications as $application)
                                <div class="rounded-xl border p-5 mt-5 shadow-md w-9/12 bg-white">
                                    <div class="flex w-full items-center justify-between border-b pb-3">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="h-8 w-8 rounded-full bg-slate-400 bg-[url('https://i.pravatar.cc/32')]">
                                            </div>
                                            <div class="text-lg font-bold text-slate-700">{{ $application->user->name }}
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-8">
                                            <button
                                                class="rounded-2xl border bg-neutral-100 px-3 py-1 text-xs font-semibold">#
                                                {{ $application->id }}</button>
                                            <div class="text-xs text-neutral-500">{{ $application->created_at }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <div class="">
                                            <div class="mt-4 mb-6">
                                                <div class="mb-3 text-xl font-bold">{{ $application->subject }}</div>
                                                <div class="text-sm text-neutral-600">{{ $application->message }}</div>
                                            </div>

                                            <div>
                                                <div class="flex items-center justify-between text-slate-500">
                                                    {{ $application->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-12 rounded hover:bg-gray-50 transition cursor-pointer border p-6">
                                            @if ($application->file_url)
                                                <a href="{{ asset('storage/' . $application->file_url) }}"
                                                    target="blank">
                                                    <svg class="w-10" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                                        stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                            d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                                                    </svg>
                                                </a>
                                            @else
                                                <p>File not available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $applications->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
