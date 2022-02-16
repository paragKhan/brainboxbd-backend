<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::paginate(env("paginate_count"));

        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        if ($request->has('photo')) {
            $fileName = Str::random(6) . '-' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('uploads/articles'), $fileName);
            $validated['photo'] = "uploads/articles/" . $fileName;
        }

        $article = Article::create($validated);

        return response()->json($article);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateArticleRequest $request
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $validated = $request->validated();

        if ($request->has("photo")) {
            $fileName = Str::random(6) . '-' . uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->move(public_path('uploads/articles'), $fileName);
            $validated['photo'] = "uploads/articles/" . $fileName;
            if (file_exists(public_path($article->photo))) {
                unlink(public_path($article->photo));
            }
        }

        $article->update($validated);

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if(file_exists(public_path($article->photo))){
            unlink(public_path($article->photo));
        }

        return response()->json($article->delete());
    }
}
