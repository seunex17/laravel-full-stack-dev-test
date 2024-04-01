<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="p-3 bg-success w-full text-white">{{session('success')}}</div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Title</th>
                                <th>State</th>
                                <th>Date Submitted</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <th>{{$ticket->ticket_id}}</th>
                                    <td>{{$ticket->title}}</td>
                                    <td>{{$ticket->status}}</td>
                                    <td>{{$ticket->created_at->toFormattedDateString()}}</td>
                                    <td>
                                        <a class="link link-primary" href="{{route('dashboard.ticket.view', $ticket->ticket_id)}}">View Ticket</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
