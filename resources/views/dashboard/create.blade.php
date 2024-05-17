<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Blog') }}
        </h2>
    </x-slot>
    <form action="{{route('dashboard.store')}}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" class="input"><br>
        <input type="text" name="title" class="input" placeholder="Title"><br>
        <textarea name="text" class="input" placeholder="Text" cols="30" rows="10"></textarea>
        <div class="option">
            <a href="{{route('dashboard.index')}}" class="button-cancel">Cancel</a>
            <button class="button-submit">Submit</button>
        </div>
    </form>
</x-app-layout>
