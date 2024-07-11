<?php
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
    $restaurant->addAttribute('id', uniqid());
    $this->Restaurants->addChild($restaurant->getName(), $restaurant->asXML());
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

  public function updateRestaurant($restaurantFilePath)
  {
    $restaurant = simplexml_load_file($restaurantFilePath);
    $restaurantId = $restaurant['id'];
    $restaurantToUpdate = $this->Restaurants->xpath("//restaurant[@id='$restaurantId']")[0];
    $restaurantToUpdate[0] = $restaurant->asXML();
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

    return $newRestaurant;
  }

}