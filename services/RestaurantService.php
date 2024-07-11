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

  public function addRestaurant($restaurantFilePath)
  {
    return $this->restaurantDAO->addRestaurant($restaurantFilePath);
  }

  public function updateRestaurant($restaurantFilePath)
  {
    return $this->restaurantDAO->updateRestaurant($restaurantFilePath);
  }

  public function deleteRestaurant($id)
  {
    return $this->restaurantDAO->deleteRestaurant($id);
  }

}