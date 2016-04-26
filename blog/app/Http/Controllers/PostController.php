<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller{
    
    public function getBlogIndex() {
        $posts = Post::paginate(5);
        foreach($posts as $post){
            $post->body = $this->shortenText($post->body, 20);
        }
        return view('front-end.blog.index', ['posts' => $posts]);
    }
    
    public function getPostIndex() {        
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.blog.index', ['posts' => $posts]);
    }
    
    public function getPost($post_id, $end = 'front-end') {
        $post = Post::find($post_id);        
        if(!$post){
            return redirect()->route('blog.index')->with(['fail' => 'Post não encontrado']);
        }                
        return view($end . '.blog.post', ['post' => $post]);
    }
    
    public function getCreatePost() {
        $categories = Category::all();
        return view('admin.blog.create_post', ['categories' => $categories]);
    }
    
    public function getUpdatePost($post_id){
        $post = Post::find($post_id);         
        $categories = Category::all();        
        $post_categories = $post->categories;         
        $post_categories_ids = array();        
        $i = 0;
        foreach ($post_categories as $post_category) {
            $post_categories_ids[$i] = $post_category->id;
            $i++;
        }        
        if(!$post){
            return redirect()->route('blog.index')->with(['fail' => 'Post não encontrado']);
        }                
        return view('admin.blog.edit_post', ['post' => $post, 'categories' => $categories, 
            'posts_categories' => $post_categories, 'post_categories_ids' => $post_categories_ids]);
    }
    
    public function getDeletePost($post_id){
        $post = Post::find($post_id);
        if(!$post){
            return redirect()->route('blog.index')->with(['fail' => 'Post não encontrado']);
        }                
        $post->delete();        
        return redirect()->route('admin.index')->with(['success' => 'Post deletado!']);
    }
    
    public function postCreatePost(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:180|unique:posts',
            'author' => 'required|max:80',
            'body' => 'required'
        ]);
        
        $post = new Post();
        $post->title = $request['title'];
        $post->author = $request['author'];
        $post->body = $request['body'];
        $post->save();        
        
        if(strlen($request['categories']) > 0){            
            $categoryIds = explode(',', $request['categories']);            
            foreach ($categoryIds as $categoryId) {
                $post->categories()->attach($categoryId);                
                
            }            
        }
        
        return redirect()->route('admin.index')->with(['success' => 'Post criado com sucesso!']);
    }
    
    public function postUpdatePost(Request $request){
        $this->validate($request, [
            'title' => 'required|max:180',
            'author' => 'required|max:80',
            'body' => 'required'
        ]);
        $post = Post::find($request['post_id']);
        $post->title = $request['title'];
        $post->author = $request['author'];
        $post->body = $request['body'];        
        
        if($post->update()){
            $post->categories()->detach();
            if(strlen($request['categories']) > 0){                  
                $categoryIds = explode(',', $request['categories']);                  
                foreach ($categoryIds as $categoryId) {
                    $post->categories()->attach($categoryId);
                }            
            }
            return redirect()->route('admin.index')->with(['success' => 'Post editado com sucesso!']);
        }else{
            return redirect()->route('admin.index')->with(['fail' => 'Não foi possivel editar o post']);
        }
    }
    
    private function shortenText($text, $words_count){
        if(str_word_count($text, 0) > $words_count){
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$words_count]) . "...";
        }
        return $text;
    }
}
