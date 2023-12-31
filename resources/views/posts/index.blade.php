<x-layout>


<!-- header -->
@include('posts._header');

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @if( $posts->count() )  <!-- Don't choke on my empty array -->                
            <x-posts-grid :posts="$posts" />

            {{ $posts->links() }}

        @else
            <p class="text-center">No posts yet</p>
        @endif

    </main>



</x-layout>