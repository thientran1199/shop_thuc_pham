<?php

namespace App\Components;

class Recusive 
{
    private $data;
    private $htmtSelect='';
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function catagoryRecusive( $parentId , $id = 0 ,$text = '')
    {
        foreach ($this->data as $value ){
            if ($value['parent_id'] == $id) {
                if (!empty($parentId) && $parentId  == $value['id']) {
                    $this->htmtSelect .= "<option selected value = '" .$value['id'] . "' >" . $text .$value['name'] . "</option>";
                }else{
                    $this->htmtSelect .= "<option  value = '" .$value['id'] . "' >" . $text .$value['name'] . "</option>";
                }
                
                $this->catagoryRecusive($parentId ,$value['id'] , $text . '--');
            }
        }
        return $this->htmtSelect;
    }
}