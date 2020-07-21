<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OrderStatusesSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $statuses = [
      [
        'name' => 'Aguardando',
        'slug' => 'on-hold',
        'isFinal' => 0,
      ],
      [
        'name' => 'Pagamento Pendente',
        'slug' => 'pending-payment',
        'isFinal' => 0,
      ],
      [
        'name' => 'Processando',
        'slug' => 'processing',
        'isFinal' => 0,
      ],
      [
        'name' => 'Completo',
        'slug' => 'completed',
        'isFinal' => 1,
      ],
      [
        'name' => 'Estornado',
        'slug' => 'refunded',
        'isFinal' => 1,
      ],
      [
        'name' => 'Cancelado',
        'slug' => 'cancelled',
        'isFinal' => 1,
      ]
    ];

    foreach ($statuses as $status) {
      DB::table('order_statuses')->insert([
        'name' => $status['name'],
        'slug' => $status['slug'],
        'isFinal' => $status['isFinal'],
      ]);
    }
  }
}
