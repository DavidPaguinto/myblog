<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Blog;
use DB;

class BlogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blogs = Blog::all();
        // $blog = Blog::where('title', 'Testing 2')->get();
        // $blogs = DB::select('SELECT * FROM blogs');
        // $blogs = Blog::orderBy('title','asc')->take(1)->get();
        $blogs = Blog::orderBy('created_at','asc')->paginate(5);
        return view('blogs.index')->with('blogs', $blogs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_summary' => 'required',
            'content' => 'required',
            'image_upload' => 'image|nullable'
        ]);
        
        // File Upload
        if($request->hasFile('image_upload'))
        {
            $fileNameWithExt = $request->file('image_upload')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_upload')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image_upload')->storeAs('public/image_uploads', $fileNameToStore);
        }
        else
        {
            $fileNameToStore = 'noimage.jpg';
        }

        //Create Blog
        $blog = new Blog;
        $blog->view_count = 0;
        $blog->status = 1;
        $blog->title = $request->input('title');
        $blog->short_summary = $request->input('short_summary');
        $blog->content = $request->input('content');
        $blog->user_id = auth()->user()->id;
        $blog->image_upload = $fileNameToStore;
        $blog->save();

        return redirect('/blogs')->with('success', 'Blog created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blogs.show')->with('blog',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);

        // Check for correct user
        if(auth()->user()->id !== $blog->user_id)
        {
            return redirect('/blogs')->with('error', 'Unauthorized Page');
        }

        return view('blogs.edit')->with('blog',$blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'short_summary' => 'required',
            'content' => 'required',
            'image_upload' => 'image|nullable'
        ]);
        
        // File Upload
        if($request->hasFile('image_upload'))
        {
            $fileNameWithExt = $request->file('image_upload')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image_upload')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image_upload')->storeAs('public/image_uploads', $fileNameToStore);
        }

        //Create Blog
        $blog = Blog::find($id);
        $blog->view_count = 0;
        $blog->status = 1;
        $blog->title = $request->input('title');
        $blog->short_summary = $request->input('short_summary');
        $blog->content = $request->input('content');
        if($request->hasFile('image_upload'))
        {
            $blog->image_upload = $fileNameToStore;
        }
        $blog->save();

        return redirect('/blogs')->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);

        // Check for correct user
        if(auth()->user()->id !== $blog->user_id)
        {
            return redirect('/blogs')->with('error', 'Unauthorized Page');
        }
        
        if($blog->image_upload != 'noimage.jpg')
        {
            //Delete Image
            Storage::delete('public/image_uploads/'.$blog->image_upload);
        }

        $blog->delete();
        return redirect('/blogs')->with('success', 'Blog deleted');
    }
}
