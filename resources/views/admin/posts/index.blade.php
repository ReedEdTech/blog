<x-layout>

    <x-setting heading="Manage Posts">

        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Posts</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the posts in your account.</p>
                </div>
                <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a href="/admin/posts/create">
                        <button type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Add Post
                        </button>
                    </a>
                </div>
            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">

                        <table class="min-w-full divide-y divide-gray-300">
                            <!-- <thead>
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                            </thead> -->
                            <tbody class="divide-y divide-gray-200 bg-white">

                            @foreach( $posts as $post )
                                <tr>
                                    <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                        <div class="flex items-center">
                                            <div class="h-11 w-11 flex-shrink-0">
                                                <a href="/?author={{ $post->author->username }}">
                                                    <img class="h-11 w-11 rounded-full" src="https://i.pravatar.cc/60?u={{ $post->author->id }}" alt="{{ $post->author->name }}">
                                                </a>                                                
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">
                                                    <a href="/posts/{{ $post->slug }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </div>
                                                <!-- <div class="mt-1 text-gray-500">
                                                    <a href="/?category={{ $post->category->slug }}">
                                                        {{ $post->category->name }}
                                                    </a>
                                                </div> -->
                                            </div>
                                        </div>
                                    </td>
                                    <!-- <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                        <div class="text-gray-900">Front-end Developer</div>
                                        <div class="mt-1 text-gray-500">Optimization</div>
                                    </td> -->
                                    <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                        <!-- <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Published</span> -->
                                        <x-category-button :category="$post->category" />
                                    </td>
                                    <!-- <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">Member</td> -->
                                    <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <a href="/admin/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit<span class="sr-only">Edit</span></a>
                                    </td>

                                    <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                        <!-- <a href="/admin/posts/{{ $post->id }}/delete" class="text-blue-500 hover:text-blue-600">Delete<span class="sr-only">Delete</span></a> -->
                                        <form method="POST" action="/admin/posts/{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class='text-xs text-gray-500 hover:text-red-600'>Delete</button>
                                        </form>

                                    </td>
                                    
                                </tr>
                            @endforeach
                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </x-setting>

</x-layout>