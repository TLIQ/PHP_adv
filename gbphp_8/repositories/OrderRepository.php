<?php


namespace App\repositories;

use App\entities\Order;

class OrderRepository extends Repository
{

  protected function getTableName(): string
  {
    return 'orders';
  }

  /**
   * @return string
   */
  protected function getEntityName(): string
  {
    return Order::class;
  }
}