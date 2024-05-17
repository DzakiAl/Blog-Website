<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <center><a href="{{ route('dashboard.create') }}" class="button-add">Add Blog</a></center>
    <div class="body">
        @foreach ($blogs as $blog)
            <a href="{{ route('home.show', $blog) }}">
                <div class="blog">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="image">
                    <div class="blog-info">
                        <h1 class="blog-title">{{ $blog->title }}</h1>
                        <p class="date">{{ $blog->created_at->format('H:i d-m-Y') }}</p>
                        <p class="user">Created by {{ $blog->user->name }}</p>
                        <form action="{{ route('dashboard.destroy', $blog) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this blog?');">
                            @csrf
                            @method('DELETE')
                            <button class="button-delete">Delete</button>
                        </form>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>
