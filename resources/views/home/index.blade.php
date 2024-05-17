<x-app-layout>
    <div class="body">
        @foreach ($blogs as $blog)
            <a href="{{ route('home.show', $blog) }}">
                <div class="blog">
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="" class="image">
                    <div class="blog-info">
                        <h1 class="blog-title">{{ $blog->title }}</h1>
                        <p class="date">{{ $blog->created_at->format('H:i d-m-Y') }}</p>
                        <p class="user">Created by {{ $blog->user->name }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</x-app-layout>