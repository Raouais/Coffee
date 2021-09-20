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
        } elseif ($type === 'password'){
            $input = '<input type="' . $type . '" name="' . $name . '" value="" class="form-control">' ;
        } else if ($type === 'file'){
            $input = '<br><input type="' . $type . '" name="' . $name . '" accept="image/png, image/jpeg, image/jpg">';
        }else {
            $input = '<input type="' . $type . '" name="' . $name . '" value="' . $this->checkInput($name) . '" class="form-control">' ;
        }
        
        return $this->surround($label . $input);
    }

    public function link($link,$action){
        $link = '<a href='.$link.'>'.$action.'</a>';
        return $this->surround($link);
    }

    public function select($name, $label, $options, $id = ""){
        $label = '<br><label>' . $label . '</label>';
        $input = '<select class="form-control" name="' . $name . '" id="'.$id.'">';
        foreach ($options as $key => $value) {
            $attributes = '';
            if(!empty($_POST) && $key == $_POST[$id]){
                $attributes = ' selected';
            }
            $input .= "<option value='$key' $attributes>$value</option>";
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


    function modalDelete($name,$title,$text,$link){
        $salt = $this->generateSalt(7);
        return '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal'.$salt.'">
            '.$name.'
        </button>

        <div class="modal fade" id="modal'.$salt.'" tabindex="-1" aria-labelledby="modal'.$salt.'Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="modal'.$salt.'Label">'.$title.'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        '.$text.'
                    </div>
                    <div class="modal-footer">
                        <a href="'.$link.'" class="btn btn-danger">Oui</a>
                        <a data-bs-dismiss="modal" class="btn btn-primary">Non</a>
                    </div>
                </div>
            </div>
        </div>';
    }

    function modal($name,$title,$text){
        $salt = $this->generateSalt(7);
        return '<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal'.$salt.'">
            '.$name.'
        </button>

        <div class="modal fade" id="modal'.$salt.'" tabindex="-1" aria-labelledby="modal'.$salt.'Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="modal'.$salt.'Label">'.$title.'</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        '.$text.'
                    </div>
                    <div class="modal-footer">
                        
                    </div>
                </div>
            </div>
        </div>';
    }
}