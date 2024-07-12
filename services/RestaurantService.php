<?php
require_once 'model/DAO/RestaurantDAO.php';
require_once 'model/domain/Restaurant.php';

class RestaurantService
{
  private $restaurantDAO;

  public function __construct()
  {
    $this->restaurantDAO = new RestaurantDAO();
  }

  public function getAll()
  {
    return $this->restaurantDAO->getAll();
  }

  public function getByid($id)
  {
    return $this->restaurantDAO->getByid($id);
  }

  public function addRestaurant($restaurant)
  {
    return $this->restaurantDAO->addRestaurant($restaurant);
  }

  public function updateRestaurant($restaurantFilePath, $id)
  {
    return $this->restaurantDAO->updateRestaurant($restaurantFilePath, $id);
  }

  public function deleteRestaurant($id)
  {
    return $this->restaurantDAO->deleteRestaurant($id);
  }

}