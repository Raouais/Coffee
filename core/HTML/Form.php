<?php 



namespace Core\HTML;

/**
 * Class Form
 * Permet de générer un formulaire rapidement et simplement
 */
class Form{

    /**
     * @var array Données utilisées par le formulaire
     */
    protected $data;
    /**
     * @var string Tag utilisée pour entourer les champs
     */
    public $surround = 'p';

    /**
     * @param array $data Données utilisées par le formulaire
     */
    public function __construct($data = array()){
        $this->data = $data;    
    }
    /**
     * @param $html string Code à entourer
     * @return string
     */

    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    /**
     * @param $name string
     * @return string
     */

    function checkInput($data, $obj = true){

        $data = trim($data); 
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if($obj){
            return $this->getValue($data);
        } else {
            return $data;
        }
    }

    protected function getValue($index){
        $array = json_decode(json_encode($this->data), true);
        if(is_object($this->data)){
            if(isset($array[$index])){
                return $this->data->$index;
            } else {
                return '';
            }
        }
        return isset($this->data[$index]) ? $this->data[$index] : null;
    }
    /**
     * @param $name string
     * @return string
     * @param array $option
     */

    public function input($name, $label, $options = []){
        $type = isset($options['type']) ? $options['type'] : 'text';
        return $this->surround(
            '<input type="' . $type . '" name="' . $name . '" placeholder="' . $name . '" value="' . $this->checkInput($name) . ' ">'
        );
    }
    /**
     * @param $name string
     * @return string
     */

    public function submit($action,$type){
        return $this->surround('<button type="submit" class="btn btn-'.$type.'">'.$action.'</button>');
    }
    /**
     * @return string
     */
    public function getData(){
        return $this->data;
    }

    public function uploadImage(&$error,&$image){
        if(!empty($_FILES["image"]["name"])){
            $salt = $this->generateSalt();
            $image = $_FILES["image"]["name"];
            $imagePath = ROOT.'public/uploads/'.$salt.'_'.basename($image);
            $image = $salt.'_'.basename($image);
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $isUploadSuccess = true;

            if($imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "jpg") {
                $error = "Les extensions d'image autorisées sont .png, .jpeg et .jpg !";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 2000000) {
                $error = "L'image ne peut pas depasser les 2MB !";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                    $error = "Erreur lors de l'upload, recommencez !";
                    $isUploadSuccess = false;
                } 
            } 
            return $isUploadSuccess;
        } 
    }

    function generateSalt($length = 16) {
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

}