<x-layout>


<!-- header -->
@include('_posts-header');

        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            <!-- MOST RECENT ARTICLE (large display) -->
            <x-post-featured-card />

            <!-- 2x1 grid with semi-featured articles -->
            <div class="lg:grid lg:grid-cols-2">
                <x-post-card />
                <x-post-card />
            </div>

            <!-- 3x1 grid of non featured articles -->
            <div class="lg:grid lg:grid-cols-3">
               <x-post-card />
               <x-post-card />
               <x-post-card />
            </div>
        </main>


        <!-- @foreach( $posts as $post)
            <article>
                <h1>
                    <a href="/posts/{{ $post->slug }} ">
                        {{ $post->title; }}
                    </a>
                </h1>
                <p>
                    By
                    <a href="/authors/{{ $post->author->username; }}">[{{ $post->author->name; }}]</a>
                     in 
                    <a href="/categories/{{ $post->category->slug; }}">[{{ $post->category->name; }}]</a>
                </p>
                <p>
                    {{ $post->excerpt; }}
                </p>
                
            </article>
        @endforeach

        <p>
            <br/>
            <strong><a href="/">Go Home </a></strong>
        </p> -->


</x-layout>