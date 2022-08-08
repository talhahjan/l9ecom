<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Section;
use App\Models\Category;
use App\Models\Product;


class FilterController extends Controller
{

    



    

    
    

    function section() {
       
// dd($this->getcolors());

        return response()->json([
            'brands'=>$this->getBrands(),
            'materials'=>$this->getMaterials(),
            'categories'=>$this->getCategories(),
            'sections'=>$this->getSections(),
        ]);
           
    
      }
    



      function category(Request $request) {
       
      return  response()->json([
    
            'brands'=>$this->getBrands(),
            'materials'=>$this->getMaterials(),
            'categories'=>$this->getSubCategories($request->section),
        ]);
           
      }


    public function getColors(){
$colors=config('services.colors');
 return $colors;
    }


    public function getsizes(){
        $sizes=config('services.sizes');
        return $sizes;
           }
       


    public function getBrands(){
        $brands=Brand::select('title','logo','link')->get();
    return $brands;
    }

public function getMaterials(){
$materials=['pu','leather','tpr','thread','rexine','pvc','slicone'];
return $materials;
}




public function getCategories(){
    $categories=Category::select('id','title','slug')->where('status',1)->get();
    return $categories;
}


public function getSubcategories($sectionId){
    $categories=Category::select('id','title','slug')->where('status',1)->where('section_id', $sectionId)->get();
    return $categories;
}

public function getSections(){
$sections=Section::select('id','title','slug')->where('status',1)->get();
return $sections;
}


}
