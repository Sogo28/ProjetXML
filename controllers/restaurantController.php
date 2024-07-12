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
    if (isset($_FILES['restaurantFile'])) {
      $info = pathinfo($_FILES['restaurantFile']['name']);
      $ext = $info['extension'];
      $newname = "newRestaurant." . $ext;
      $target = 'uploads/' . $newname;
      move_uploaded_file($_FILES['restaurantFile']['tmp_name'], $target);
    }
    $isAdded = $this->restaurantService->addRestaurant($target);
    if ($isAdded[0]) {
      header('Location: index.php?action=restaurant');
    } else {
      $this->showError($isAdded[1]);
    }
  }

  public function updateRestaurant()
  {
    if (isset($_FILES['restaurantFile']) && isset($_GET['id'])) {
      $info = pathinfo($_FILES['restaurantFile']['name']);
      $ext = $info['extension'];
      $newname = "updatedRestaurant." . $ext;
      $target = 'uploads/' . $newname;
      move_uploaded_file($_FILES['restaurantFile']['tmp_name'], $target);
    }
    $id = $_GET['id'];
    $isUpdated = $this->restaurantService->updateRestaurant($target, $id);
    if ($isUpdated[0]) {
      header('Location: index.php?action=restaurant');
    } else {
      $this->showError($isUpdated[1]);
    }
  }

  public function deleteRestaurant()
  {
    $isDeleted = $this->restaurantService->deleteRestaurant($_GET['id']);
    if ($isDeleted[0]) {
      header('Location: index.php?action=restaurant');
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