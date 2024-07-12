<?php
require_once 'model/domain/ExSimpleXMLElement.php';
class RestaurantDAO
{
  public $dataPath = 'data\restaurants.xml';
  public $Restaurants;
  private function isValid($dataPath)
  {
    if (!file_exists($dataPath)) {
      return false;
    }
    $dom = new DOMDocument();
    $dom->Load($dataPath);
    libxml_use_internal_errors(true);
    if (!$dom->validate()) {
      $errors = "";
      foreach (libxml_get_errors() as $error) {
        $errors .= $error->message . "<br>";
      }
      return [false, $errors];
    } else {
      return [true, null];
    }
  }

  function __construct()
  {
    if ($this->isValid($this->dataPath)[0]) {
      $this->Restaurants = simplexml_load_file($this->dataPath);
    } else {
      exit("Le fichier xml n'est pas valide.");
    }
  }

  public function getAll()
  {
    $allRestaurants = [];
    foreach ($this->Restaurants->restaurant as $restaurant) {
      if ($restaurant['deleted'] == 'false') {
        $allRestaurants[] = $this->mapToRestaurant($restaurant);
      }
    }
    return $allRestaurants;
  }

  public function getByid($id)
  {
    return $this->mapToRestaurant($this->Restaurants->xpath("//restaurant[@id='$id']")[0]);
  }

  public function addRestaurant($restaurantFilePath)
  {
    $restaurant = simplexml_load_file($restaurantFilePath);
    // generate NCNAME type id for the restaurant
    $restaurant->addAttribute('id', "R" . strtoupper(uniqid()));
    $restaurant->addAttribute('deleted', 'false');
    $restaurants = new ExSimpleXMLElement($this->dataPath, 0, true);

    // add all childs of the restaurant to the Restaurants xml
    $restaurants->appendXML($restaurant);
    $restaurants->asXML('data\\restau_temp.xml');
    $isValid = $this->isValid('data\\restau_temp.xml');
    if ($isValid[0]) {
      $restaurants->asXML($this->dataPath);
      unlink("data\\restau_temp.xml");
      return [true, null];
    } else {
      return [false, $isValid[1]];
    }
  }

  public function updateRestaurant($restaurantFilePath, $id)
  {
    // update the restaurant using the appendXML method
    $restaurant = simplexml_load_file($restaurantFilePath);
    $restaurant->addAttribute('id', $id);
    $restaurant->addAttribute('deleted', 'false');
    $restaurants = new ExSimpleXMLElement($this->dataPath, 0, true);
    $restaurantToUpdate = $restaurants->xpath("//restaurant[@id='$id']")[0];
    if ($restaurantToUpdate) {
      // Mettre à jour les informations du restaurant
      foreach ($restaurant->children() as $child) {
        // Supprimer les anciens éléments avant d'ajouter les nouveaux
        unset($restaurantToUpdate->{$child->getName()});
        $restaurantToUpdate->appendXML($child);
      }

      // Sauvegarder les modifications dans un fichier temporaire
      $restaurants->asXML('data\\restau_temp.xml');

      $isValid = $this->isValid('data\\restau_temp.xml');
      if ($isValid[0]) {
        $restaurants->asXML($this->dataPath);
        unlink('data\\restau_temp.xml');
        return [true, null];
      } else {
        return [false, $isValid[1]];
      }
    } else {
      return [false, "Restaurant non trouvé."];
    }


  }

  public function deleteRestaurant($id)
  {
    $restaurantToDelete = $this->Restaurants->xpath("//restaurant[@id='$id']")[0];
    $restaurantToDelete['deleted'] = 'true';
    $this->Restaurants->asXML('data\\restau_temp.xml');
    $isValid = $this->isValid('data\\restau_temp.xml');
    if ($isValid[0]) {
      $this->Restaurants->asXML($this->dataPath);
      unlink("data\\restau_temp.xml");
      return [true, null];
    } else {
      return [false, $isValid[1]];
    }
  }

  public function mapToRestaurant($restaurant)
  {
    $newRestaurant = new Restaurant();
    $newRestaurant->id = $restaurant['id'];
    $newRestaurant->nom = $restaurant->coordonnees['nom'];
    $newRestaurant->adresse = $restaurant->coordonnees['adresse'];
    $newRestaurant->nomRestaurateur = (string) $restaurant->nom_restaurateur;
    $newRestaurant->setDescription($restaurant->description);
    $newRestaurant->setCarte($restaurant->carte);
    $newRestaurant->setMenus($restaurant->liste_menu, $restaurant->carte);
    return $newRestaurant;
  }

}