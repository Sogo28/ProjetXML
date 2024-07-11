<?php
class Restaurant
{
  public $id;
  public $nom;
  public $adresse;
  public $nomRestaurateur;
  public $description;
  public $carte;
  public $menus;

  public function setDescription($description)
  {
    $descriptionFormatee = '';

    foreach ($description->paragraphe as $paragraphe) {
      $descriptionFormatee .= '<p class="p-2 border border-slate-300">';
      foreach ($paragraphe->children() as $child) {
        switch ($child->getName()) {
          case 'partie_texte_important':
            $descriptionFormatee .= '<strong>' . (string) $child . '</strong>';
            break;
          case 'image':
            $position = (string) $child['position'];
            $src = (string) $child['url'];
            switch ($position) {
              case 'gauche':
                $classe = 'float-left block mr-4 w-1/2';
                break;
              case 'droite':
                $classe = 'float-right block ml-4 w-1/2';
                break;
              case 'centre':
                $classe = 'mx-auto block w-1/2';
                break;
              default:
                $classe = '';
                break;
            }
            $descriptionFormatee .= '<img src="' . $src . '" class="' . $classe . '" alt="une image">';
            break;
          default:
            $descriptionFormatee .= (string) $child;
            break;
        }
      }
      $descriptionFormatee .= (string) $paragraphe;
      $descriptionFormatee .= '</p>';
    }
    $this->description = $descriptionFormatee;
  }
}