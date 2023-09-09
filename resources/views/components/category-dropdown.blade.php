<x-dropdown>
    <!-- Got fancy.  Need to fill in more than one spot in the dropdown component-->
    <!-- use x-slot tag & give it a name that matches the placeholder we used in the component -->
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-32 text-left inline-flex">

            <!--  So cool:  the categories view passes $currentCategory, but others don't.  
                        Use that variable to see if a category is selected.  Display that cat (or just 'Categories' if nothing is selected)
                         -->
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

            <!-- blade component for an icon.  Loading the arrow -->
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />

        </button>
    </x-slot>


    <!-- This part is the default "slot" & will get filed into that location in the dropdown component -->
    <x-dropdown-item href="/?{{ http_build_query( request()->except('category', 'page') ) }}" :active="request('category')==null">
        All
    </x-dropdown-item>

    @foreach( $categories as $category)
    <x-dropdown-item href="?category={{$category->slug}}&{{ http_build_query( request()->except('category', 'page') ) }}" 
        :active='$category->is($currentCategory)'
        >
        {{ucwords($category->name)}}
    </x-dropdown-item>

    @endforeach
    <!-- end of the default "slot" -->

</x-dropdown>