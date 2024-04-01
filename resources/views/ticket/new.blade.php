<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Submit New Ticket
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">
                <div class="flex flex-col gap-3 justify-center">
                    <h3 class="text-lg font-semibold">Create Ticket</h3>
                    @if(session('error'))
                        <div class="p-3 bg-error w-full text-white">{{session('error')[0]}}</div>
                    @endif
                    <form action="{{route('dashboard.ticket.create')}}" class="space-y-3" method="post">
                        @csrf
                        <label class="form-control w-full" for="title">
                            <div class="label">
                                <span class="label-text">Title</span>
                            </div>
                            <input type="text" id="title" name="title" value="{{old('title')}}" placeholder="Title" class="input input-bordered w-full" />
                        </label>
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text">Category</span>
                            </div>
                            <select class="select select-bordered" name="agent_id">
                                @foreach($agents as $agent)
                                    <option value="{{$agent->id}}">{{$agent->name}}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control">
                            <div class="label">
                                <span class="label-text">Comment</span>
                            </div>
                            <textarea class="textarea textarea-bordered h-24" name="comment" placeholder="Comment">{{old('comment')}}</textarea>
                        </label>
                        <div class="block">
                            <button type="submit" class="btn btn-primary btn-block">Submit Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
