<?php

namespace App\Controller;

use App\Base\Request\Request;
use App\Model\Book;
use App\Model\Disc;
use App\Model\Furniture;
use App\Model\Products;

class ProductsController{
    private Request $request;
    private $errorMessage = "";

    function __construct(Request $request){
        $this->request = $request;
    }

    public function get_front(){
        
        $result = (new Products())->selectAll();
        return $this->render('front', ['result' => $result]);
    }

    public function get_add_product(){
        return $this->render('add_products');
    }

    public function store(){
        $productType = $this->request->get('type');
        $sku = $this->request->get('sku');
        $name = $this->request->get('name');
        $price = $this->request->get('price');
        $weight = $this->request->get('weight');
        $size = $this->request->get('size');
        $height = $this->request->get('height');
        $width = $this->request->get('width');
        $length = $this->request->get('length');
        // $ = $this->request->get('');
        // $ = $this->request->get('');

        // return $this->();
        return $this->get_front();

    }

    public function delete(){
        //
    }

    public function __toString(){
        return $this->render();
    }

    private function render($view = 'front.template.php', $args = []){
        // make variables in a class
        foreach ($args as $key => $value){
            #code
            $this->{$key} = $value;
        }
        ob_start();
        include('resources/view/' . $view . 'template.php'); // or wherever the template is located
        return ob_get_clean();
    }
/* Method Setup
 * public function (){
 *      return $this->();
 * }
*/
    
}



?>