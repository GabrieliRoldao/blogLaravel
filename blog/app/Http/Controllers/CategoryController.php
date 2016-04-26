<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller {

    private $oldCategories;
    
    public function getCategoryIndex() {
        $categories = Category::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.blog.categories', ['categories' => $categories]);
    }

    public function postCreateCategory(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ]);

        $category = new Category();
        $category->name = $request['name'];        
        if ($category->save()) {
            $this->oldCategories = Category::all();
            if(count($this->oldCategories)== 6){
                return response()->json(['message' => 'Categoria adicionada', 'categoria' => $this->createArticle($category), 'firsTime' => true], 200);            
            }else{
                return response()->json(['message' => 'Categoria adicionada', 'categoria' => $this->createArticle($category)], 200);            
            }
        } else {
          return response()->json(['message' => 'Erro durante a criação'], 404);
        }
    }
    
    public function postUpdateCategory(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ]);
        
        $category = Category::find($request['category_id']);
        if(!$category){
            return response()->json(['message' => 'Categoria nao foi encontrada para edição'], 404);
        }
        $category->name = $request['name'];
        $category->update();
        return response()->json(['message' => 'Categoria atualizada', 'newName'=>$category->name, 'success' => 'success'], 200);
    }
    
    public function getDeleteCategory($category_id) {
        $category = Category::find($category_id);
        $category->delete();
        return response()->json(['message' => 'Categoria deletada', 'success' => 'success'], 200);
    }
    
    private function createArticle($category){
        return $article = "<article>" 
                                . "<div class=\"category-info\" data-id=\"{$category->id}\" id=\"article\">"
                                    . "<h3>{$category->name}</h3>"
                                . "</div>"                            
                                . "<div class=\"edit\">"
                                    . "<nav>"
                                        . "<ul>"
                                            . '<li class="category-edit"><input type="text" /></li>'
                                            .  '<li class="editar"><a href="#">Editar</a></li>' . " "
                                            .  '<li><a href="#" class="danger">Excluir</a></li>'
                                        .  "</ul>"
                                    .  "</nav>"
                                .  "</div>"
                        .  '</article>';
    }
}
