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
    $dom = new DOMDocument();
    $dom->formatOutput = true;

    $xmlString = '<description>' . $description->asXML() . '</description>';
    $dom->loadXML($xmlString);

    $descriptionFormatee = '';

    // Traiter chaque paragraphe
    foreach ($dom->getElementsByTagName('paragraphe') as $paragraphe) {
      $descriptionFormatee .= '<p class="p-2 border border-slate-300">';

      foreach ($paragraphe->childNodes as $child) {
        if ($child->nodeType === XML_TEXT_NODE) {
          $descriptionFormatee .= htmlspecialchars($child->nodeValue);
        } elseif ($child->nodeType === XML_ELEMENT_NODE) {
          switch ($child->nodeName) {
            case 'partie_texte_important':
              $descriptionFormatee .= '<strong>' . htmlspecialchars($child->nodeValue) . '</strong>';
              break;
            case 'image':
              $position = $child->getAttribute('position');
              $src = $child->getAttribute('url');
              $classe = $this->getImageClass($position);
              $descriptionFormatee .= '<img src="' . htmlspecialchars($src) . '" class="' . $classe . '" alt="une image">';
              break;
          }
        }
      }

      $descriptionFormatee .= '</p>';
    }

    $this->description = $descriptionFormatee;
  }

  private function getImageClass($position)
  {
    switch ($position) {
      case 'gauche':
        return 'float-left block mr-4 w-1/2';
      case 'droite':
        return 'float-right block ml-4 w-1/2';
      case 'centre':
        return 'mx-auto block w-1/2';
      default:
        return '';
    }
  }

  public function setCarte($carte)
  {
    $dom = new DOMDocument();
    $dom->formatOutput = true;

    $xmlString = '<carte>' . $carte->asXML() . '</carte>';
    $dom->loadXML($xmlString);
    $carteFormatee = '';
    // Traiter chaque plat
    foreach ($dom->getElementsByTagName('plat') as $plat) {
      $id = $plat->getAttribute('id');
      $type = $plat->getAttribute('type_plat');

      $prixNode = $plat->getElementsByTagName('prix')[0];
      $montant = $prixNode->getAttribute('montant');
      $devise = $prixNode->getAttribute('devise');

      $descriptionNode = $plat->getElementsByTagName('desc_plat')[0];
      $descriptionFormatee = '';

      // Traiter les paragraphes dans desc_plat
      foreach ($descriptionNode->getElementsByTagName('paragraphe') as $paragraphe) {
        $descriptionFormatee .= '<p>';
        foreach ($paragraphe->childNodes as $child) {
          switch ($child->nodeName) {
            case 'partie_texte_important':
              $descriptionFormatee .= '<strong>' . htmlspecialchars($child->nodeValue) . '</strong>';
              break;
            case 'image':
              $position = $child->getAttribute('position');
              $src = $child->getAttribute('url');
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
              $descriptionFormatee .= '<img src="' . htmlspecialchars($src) . '" class="' . $classe . '" alt="une image">';
              break;
            default:
              $descriptionFormatee .= htmlspecialchars($child->nodeValue);
              break;
          }
        }
        $descriptionFormatee .= '</p>';
      }

      // Construire le HTML pour chaque plat
      $carteFormatee .= '<div class="plat mb-4 p-4 border border-slate-300">';
      $carteFormatee .= '<h3 class="text-lg font-bold">' . $descriptionFormatee . '</h3>';
      $carteFormatee .= '<p class="text-sm">Prix: ' . htmlspecialchars($montant) . ' ' . htmlspecialchars($devise) . '</p>';
      $carteFormatee .= '<p class="text-sm">Type: ' . htmlspecialchars($type) . '</p>';
      $carteFormatee .= '</div>';
    }

    $this->carte = $carteFormatee;
  }

  public function setMenus($listeMenu, $plats)
  {
    $menusFormates = '';
    $choixOrdre = (string) $listeMenu['choix_ordre'];
    $menus = [];
    foreach ($listeMenu->menu as $menu) {
      $menus[] = $menu;
    }
    if ($choixOrdre === 'prix') {
      usort($menus, function ($a, $b) {
        $prixA = (float) $a->prix['montant'];
        $prixB = (float) $b->prix['montant'];
        return $prixA <=> $prixB;
      });
    } elseif ($choixOrdre === 'apparition') {
    }
    // Traiter chaque menu dans liste_menu
    foreach ($menus as $menu) {
      $titre = (string) $menu->titre;
      $descriptionMenu = (string) $menu->description_menu;
      $prixMontant = $menu->prix['montant'];
      $prixDevise = $menu->prix['devise'];

      // Construire le HTML pour le menu
      $menusFormates .= '<div class="menu mb-4 p-4 border border-slate-300">';
      $menusFormates .= '<h3 class="text-lg font-bold">' . htmlspecialchars($titre) . '</h3>';
      $menusFormates .= '<p class="text-sm">' . htmlspecialchars($descriptionMenu) . '</p>';
      $menusFormates .= '<p class="text-sm font-semibold">Prix: ' . htmlspecialchars($prixMontant) . ' ' . htmlspecialchars($prixDevise) . '</p>';

      $menusFormates .= '<ul class="list-disc pl-5">';

      // Traiter chaque élément de menu
      foreach ($menu->liste_elem_menu->elem_menu as $elem) {
        $platRef = (string) $elem['plat_ref'];

        // Chercher la description du plat avec l'attribut plat_ref
        foreach ($plats->plat as $plat) {
          if ((string) $plat['id'] === $platRef) {
            $typePlat = (string) $plat['type_plat'];
            $descPlat = (string) $plat->desc_plat->paragraphe;

            $menusFormates .= '<li>' . htmlspecialchars($descPlat) . ' (' . htmlspecialchars($typePlat) . ')</li>';
            break;
          }
        }
      }

      $menusFormates .= '</ul>';
      $menusFormates .= '</div>';
    }

    $this->menus = $menusFormates;
  }

}