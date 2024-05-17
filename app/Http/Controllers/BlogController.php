<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')
        ->where('user_id', request()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();;
        return view('dashboard.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image'],
            'title' => ['required', 'string'],
            'text' => ['required', 'string']
        ]);
        
        // Handle file upload
        $imageName = $request->file('image')->getClientOriginalName(); // Get the original file name
        $imageNameWithoutExtension = pathinfo($imageName, PATHINFO_FILENAME); // Get the file name without extension
        $imageExtension = $request->file('image')->getClientOriginalExtension(); // Get the file extension
        
        $i = 1;
        $uniqueImageName = $imageName;
        while (Storage::exists('public/blog_images/' . $uniqueImageName)) {
            $uniqueImageName = $imageNameWithoutExtension . '_' . $i . '.' . $imageExtension; // Append a number to the file name
            $i++;
        }
        
        $imagePath = $request->file('image')->storeAs('public/blog_images', $uniqueImageName); // Store the image with the unique name
        
        // Prepend "blog_images/" to the file name to be stored in the database
        $imageNameForDatabase = 'blog_images/' . $uniqueImageName;
        
        // Create new Blog entry
        $blog = new Blog();
        $blog->image = $imageNameForDatabase; // Save the image path to the database
        $blog->title = $data['title'];
        $blog->text = $data['text'];
        $blog->user_id = $request->user()->id;
        $blog->save();
        
        return redirect()->route('dashboard.index', $blog);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Delete the image from storage
        if (Storage::exists('public/' . $blog->image)) {
            Storage::delete('public/' . $blog->image);
        }

        // Delete the blog
        $blog->delete();

        return redirect()->route('dashboard.index');
    }
}
