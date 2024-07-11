<?php
require_once 'services/RestaurantService.php';

class RestaurantController
{
  private $restaurantService;

  public function __construct()
  {
    $this->restaurantService = new RestaurantService();
  }

  public function showIndex()
  {
    $restaurants = $this->restaurantService->getAll();
    require_once 'views/restaurants/accueil.php';
  }

  public function showAddRestaurant()
  {
    require_once 'views/restaurants/addRestaurant.php';
  }

  public function showUpdateRestaurant()
  {
    $restaurant = $this->restaurantService->getByid($_GET['id']);
    require_once 'views/restaurants/updateRestaurant.php';
  }

  public function addRestaurant()
  {
    // the add form will only contain a file input allowing to upload a restaurant xml file
    $restaurantFilePath = $_FILES['restaurantFile']['tmp_name'];
    $isAdded = $this->restaurantService->addRestaurant($restaurantFilePath);
    if ($isAdded[0]) {
      $this->showIndex();
    } else {
      $this->showError($isAdded[1]);
    }
  }

  public function updateRestaurant()
  {
    // the update form will only contain a file input allowing to upload a restaurant xml file
    $restaurantFilePath = $_FILES['restaurantFile']['tmp_name'];
    $isUpdated = $this->restaurantService->updateRestaurant($restaurantFilePath);
    if ($isUpdated[0]) {
      $this->showIndex();
    } else {
      $this->showError($isUpdated[1]);
    }
  }

  public function deleteRestaurant()
  {
    $isDeleted = $this->restaurantService->deleteRestaurant($_GET['id']);
    if ($isDeleted[0]) {
      $this->showIndex();
    } else {
      $this->showError($isDeleted[1]);
    }
  }

  public function showError($errorMessage = 'Une erreur est survenue')
  {
    require_once 'views/error.php';
  }

  public function showRestaurant($id)
  {
    $restaurant = $this->restaurantService->getByid($id);
    require_once 'views/restaurants/restaurant.php';
  }


}