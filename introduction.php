<?php
// $nom = "Jackson";
// $prenom = "Michael";
// $age = 32;

// $nom2 = "Carey";
// $prenom2 = "Mariah";
// $age2 = 33;

// function presentation($nom, $prenom, $age) //parametres de la fonction
// {
//     var_dump("Bonjour, je m'appelle $prenom $nom et j'ai $age ans");
// }


//2 implements travailler et fonction travailler
//3 class Humain et employé et étudiant hérite de humain, remplace interface travailleur ??

abstract class Humain { // la classe abstraite definit des méthodes abstraites comme l'interface mais a plus de choses 

  // !!!!!on ne peut pas créer d'humain à partir d'une classe abstraite !!!!!! donc pas de $humain

    protected $nom;   //propriété, variable qui fait partie d'un objet
    protected $prenom; //quand c'est public, on peut modifier.
    protected $age;  //private: les propriétes sont disponibles que dans les fonctions déclarées dans cette classe, propriété qui ne peut être
    // modifié que dans une fonction qui est declarée dans la class Employe"
    // protected : propriete protegée, mais accessible aux autres classes par héritage

    public function __construct($prenom, $nom, $age) //contructeur, permet de passer des informations à l'objet dès sa naissance, rappel new Employe
    {
        $this->nom = $nom; //le nom de ceci doit etre egal au nom qu'on m'a envoyé
        $this->prenom = $prenom; //le prenom de ceci doit etre egal au prenom qu'on m'a envoyé
        // $this->age = $age;
        $this->setAge($age); //après la condition dans mon set, permet d'empecher de mettre n'importe quoi dans age
        //var_dump("Je suis construit");
    }

    abstract public function travailler(); //fonction qui n'a pas de sens

    public function setAge($age) // recevoir un age, "mon age c'est l'age qu'on m'a envoyé --- après presentation()
    {
        if (is_int($age) && $age >= 1 && $age <= 120) { // si la fonction is-it est en entier
            $this->age = $age; //l'age de ceci(objet) c'est l'age qu'on m'a envoyé
        } else {
            throw new Exception("L'âge d'un employé devrait être un entier entre 1 et 120!");
        }
    }
    public function getAge() //delivrer l'age de l'employé
    {
        return $this->age;
    }

}

// interface Travailleur { //interface definit des méthodes abstraites que l'on veut rendre obligatoire dans tous les objets qui se definissent comme des travailleurs, 
    //contrat que passe les objets avec les interfaces
// public function travailler();
// }




// class Employe implements Travailleur 
class Employe extends Humain //car on dit ce que fait la fonction travailler -extends Humain??
{ //representation
    // protected $nom;   //propriété, variable qui fait partie d'un objet
    // protected $prenom; //quand c'est public, on peut modifier.
    // protected $age;  //private: les propriétes sont disponibles que dans les fonctions déclarées dans cette classe, propriété qui ne peut être
    // // modifié que dans une fonction qui est declarée dans la class Employe"
    // // protected : propriete protegée, mais accessible aux autres classes par héritage

    // public function __construct($prenom, $nom, $age) //contructeur, permet de passer des informations à l'objet dès sa naissance, rappel new Employe
    // {
    //     $this->nom = $nom; //le nom de ceci doit etre egal au nom qu'on m'a envoyé
    //     $this->prenom = $prenom; //le prenom de ceci doit etre egal au prenom qu'on m'a envoyé
    //     // $this->age = $age;
    //     $this->setAge($age); //après la condition dans mon set, permet d'empecher de mettre n'importe quoi dans age
    //     //var_dump("Je suis construit");
    // }

    public function travailler()
    {
        return "Je suis un employé et je travaille";
    }

    // public function setAge($age) // recevoir un age, "mon age c'est l'age qu'on m'a envoyé --- après presentation()
    // {
    //     if (is_int($age) && $age >= 1 && $age <= 120) { // si la fonction is-it est en entier
    //         $this->age = $age; //l'age de ceci(objet) c'est l'age qu'on m'a envoyé
    //     } else {
    //         throw new Exception("L'âge d'un employé devrait être un entier entre 1 et 120!");
    //     }
    // }
    // public function getAge() //delivrer l'age de l'employé
    // {
    //     return $this->age;
    // }
    //function presentation($nom, $prenom, $age) parametres de la fonction
    public function presentation()
    {
        var_dump("Salut, je m'appelle $this->prenom $this->nom et j'ai $this->age ans"); //this represente l'objet
    }
}

class Patron extends Employe
{ //representation
    //la class Patron spécialise la classe Employe
    public $voiture;

    public function __construct($prenom, $nom, $age, $voiture) //contructeur, permet de passer des informations à l'objet dès sa naissance, rappel new Employe
    {
        parent::__construct($prenom, $nom, $age); //sinon on perd les propriétés
        $this->voiture = $voiture; //"ma voiture c'est la voiture qu'on m'a passé"
    }

    public function travailler()
    {
        return "Je suis le patron et je bosse aussi!";
    }

    public function presentation()
    {
        parent::presentation();
        var_dump("Bonjour, je m'appelle $this->prenom $this->nom et j'ai $this->age ans, et j'ai une voiture!"); //this represente l'objet
    }



    public function rouler()
    {
        var_dump("Bonjour, je roule avec ma $this->voiture !");
    }
}

//$employe1 = new Employe(); employe1 est une instance de Employe, véritable objet
$employe1 = new Employe("Jackson", "Michael", 50);
//$employe1->prenom = "Michael"; ->opérateur, en javascript c'est le .
// $employe1->nom = "Jackson";
// $employe1->age = 60;


// $employe1->age = "heehee"; interdit

$employe2 = new Employe("Carey", "Mariah", 50);
// $employe2->prenom = "Mariah";
// $employe2->nom = "Carey";
// $employe2->age = 50;
$employe2->setAge(60);
$employe1->presentation();
$employe2->presentation();

$patron = new Patron("Jean-Claude", "Vandamne", 55, "BMW");

//$employe1->presentation($employe1->nom, $employe1->nom, $employe1->age); rappel de la methode, on est obligé de passer par l'objet pour l'appeller

$patron->presentation();
$patron->rouler();

// class Etudiant implements Travailleur 
class Etudiant extends Humain {
    public function travailler()
    {
        return "Je suis un étudiant et je révise";
    }

}

$etudiant = new Etudiant("Sajrane", "Samia", 33); //toujours mettre les arguments

faireTravailler($employe1);
faireTravailler($patron);
faireTravailler($etudiant);

// function faireTravailler(Travailleur $objet) //un objet de type travailleur
function faireTravailler(Humain $objet) { //un objet de type humain
var_dump("Travail en cours : {$objet->travailler()}"); //notion d'interface: contrat qu'une classe signe et qu'elle doit respecter
} //pas de plantage
//dry dont repeat yourself 
//notion d'abstraction: on veut juste faire 
//polymorphisme : une fonction de même nom qui ne donne pas les mêmes comportements
// encapsulation
