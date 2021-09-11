<?php

namespace Core\HTML;

class Bootstrap extends Form{

        /**
     * @param $html string Code à entourer
     * @return string
     */

    protected function surround($html){
        return "<div class=\"form-group\">{$html}</div>";
    }
    
    /**
     * @param $name string
     * @return string
     * @param array $option
     */
    public function input($name, $label, $options = []){
        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = '<label>' . $label . '</label>';
        if($type === 'textarea'){
            $input = '<textarea " class="form-control" name="' . $name .'">' . $this->checkInput($name) . '</textarea>' ;    
        } elseif ($type === 'checkbox'){
            $input = '<input type="' . $type . '" name="' . $name . '" value="1" class="form-control">' ;
        }else {
            $input = '<input type="' . $type . '" name="' . $name . '" value="' . $this->checkInput($name) . '" class="form-control">' ;
        }
        return $this->surround($label . $input);
    }

    public function link($link,$action){
        $link = '<a href='.$link.'>'.$action.'</a>';
        return $this->surround($link);
    }

    public function select($name, $label, $options){
        $label = '<label>' . $label . '</label>';
        $input = '<select class="form-control" name="' . $name . '">';
        foreach ($options as $key => $value) {
            $attributes = '';
            if($key == $this->checkInput($name)){
                $attributes = ' selected';
            }
            $input .= "<option value='$key'$attributes>$value</option>";
        }
        $input .= '</select>';
        return $this->surround($label . $input);
    }

        /**
     * @param $name string
     * @return string
     */

    public function submit($action,$type){
        return $this->surround('<button type="submit" class="btn btn-'.$type.'">'.$action.'</button>');
    }
    
}