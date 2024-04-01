<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$ticket->title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="flex flex-col gap-3 justify-center">
                    <h3 class="text-lg font-semibold">Discussions</h3>
                    @if(session('success'))
                        <div class="p-3 bg-success w-full text-white">{{session('success')[0]}}</div>
                    @endif
                    <p class="font-light text-warning text-sm">You wrote</p>
                    <div>
                        {{$ticket->comment}}
                    </div>
                    <div class="divider text-center">Replies</div>
                    @if($ticket->comments)
                        <div class="flex flex-col gap-3">
                            @foreach($ticket->comments as $comment)
                                <div class="p-3 bg-base-300 border border-primary">
                                    <span>{{$comment->comment}}</span><span class="text-xs font-light"> by: @if($comment->user_id == auth()->id()) Me @else Agent @endif</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div>
                        <form action="{{route('dashboard.ticket.create.comment')}}" class="flex flex-col gap-4" method="post">
                            @csrf
                            <label class="form-control">
                                <div class="label">
                                    <span class="label-text">Comment</span>
                                </div>
                                <textarea class="textarea textarea-bordered h-24" name="comment" placeholder="Comment" required>{{old('comment')}}</textarea>
                            </label>
                            <div class="block">
                                <button type="submit" class="btn btn-primary btn-block">Submit Ticket</button>
                            </div>
                            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
