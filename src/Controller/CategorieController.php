<?php
namespace src\Controller;

use src\Model\Article;
use src\Model\BDD;
use src\Model\Categorie;

class CategorieController extends AbstractController {

    public function Add(){
        if($_POST){
            $objCategorie = new Categorie();
            $objCategorie->setLibelle($_POST["Libelle"]);
            $objCategorie->setIcone($_POST["Icone"]);
            //Exécuter l'insertion
            $id = $objCategorie->SqlAdd(BDD::getInstance());
            // Redirection
            header("Location:/categorie/show/$id");
        }else{
            return $this->twig->render("Categorie/add.html.twig");
        }


    }

    public function All(){
        $categorie = new Categorie();
        $datas = $categorie->SqlGetAll(BDD::getInstance());

        return $this->twig->render("Categorie/all.html.twig", [
            "CategorieList"=>$datas
        ]);
    }

    public function Show($id){
        $categorie = new Categorie();
        $datas = $categorie->SqlGetById(BDD::getInstance(),$id);

        return $this->twig->render("Categorie/show.html.twig", [
            "categorie"=>$datas
        ]);
    }

    public function Delete($id){
        $categorie = new Categorie();
        $datas = $categorie->SqlDeleteById(BDD::getInstance(),$id);

        header("Location:/Categorie/All");
    }

    public function Update($id){
        $categorie = new Categorie();
        $datas = $categorie->SqlGetById(BDD::getInstance(),$id);

        if($_POST){
            $objCategorie = new Categorie();
            $objCategorie->setLibelle($_POST["Libelle"]);
            $objCategorie->setIcone($_POST["Icone"]);

            //Exécuter la mise à jour
            $objCategorie->SqlUpdate(BDD::getInstance());
            // Redirection
            header("Location:/categorie/show/$id");
        }else{
            return $this->twig->render("Categorie/update.html.twig", [
                "categorie"=>$datas
            ]);
        }

    }


}