<?php

namespace Model\Entity;

abstract class BaseEntity
{
    protected $id;


    public function __toString()
    {
        // retourne le nom de la classe à partir de son namespase 
        // exemple : Model\Entity\Product
        $class = get_called_class();

        // Découpe une chaine de caractèrs dès qu'il rencotre un caractère spécifique ici c'est le "\"
        // Elle retourne ensuite un tableau indexé contenant les élément dans la chaine de caractères
        // Exemple : 
        // ["Model","Entity","Product"]

        $class = explode("\\", $class);
        $table = $class[count($class) - 1];
        // strtolower = met tous les caractères d'un string en minuscule
        return strToLower($table);
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
