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

    function checkInput($data){

        $data = trim($data); 
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $this->getValue($data);
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

    public function checkImage($file){
        if(!empty($_FILES["image"]["name"])){
            $image = $file;
            $imagePath = ROOT.'public/uploads/'.$this->generateSalt().'_'.basename($image);
            $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
            $isUploadSuccess = true;

            if($imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "jpg") {
                $array["image"] = $form->messageError("Les extensions d'image autorisées sont .png, .jpeg et .jpg !");
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 2000000) {
                $array["image"] = $form->messageError("L'image ne peut pas depasser les 2MB !");
                $isUploadSuccess = false;
            }
            if($isUploadSuccess) {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)){
                    $array["image"] = $form->messageError("Erreur lors de l'upload, recommencez !");
                    $isUploadSuccess = false;
                } 
            } 
            if($isUploadSuccess){
                $dao->setTable("image");
                $dao->create(array('name' => $image, "path" => $imagePath));
                $fields['refImage'] = $dao->getLastId();
            }
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