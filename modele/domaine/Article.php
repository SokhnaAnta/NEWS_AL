
<?php
class Article {
    public $id;
    public $titre;
    public $contenu;
    public $categorie;
    public $dateCreation ;
	public $dateModification ;
    public $utilisateur_id ;

    public function toArray() {
        return get_object_vars($this);
    }
}