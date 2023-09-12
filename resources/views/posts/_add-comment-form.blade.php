@auth
<x-panel>
    <form method="POST" action="/posts/{{$post->slug}}/comments">
        @csrf
        <header class="flex items-center">
            <img src="https://i.pravatar.cc/60?u={{ auth()->user()->id }}" alt="" width="40" height="40" class="rounded-full">
            <h2 class="ml-4">Want to participate?</h2>
        </header>

        <div class="mt-5">
            <textarea name="body" id="" required class="w-full text-sm focus:outline-none focus:ring" rows="5" placeholder="Quick, think of something to say!"></textarea>
            @error("body")
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 pt-6">
            <x-submit-button>Post Comment</x-submit-button>
        </div>

    </form>
</x-panel>
@else
<p class="font-semibold">
    <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">log In</a> to leave a comment.
</p>
@endauth