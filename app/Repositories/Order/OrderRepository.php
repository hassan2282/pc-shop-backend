<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use GuzzleHttp\Client;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
   public function __construct(Order $order)
   {
      parent::__construct($order);
   }


   public function allOrdersWithRelations()
   {
      $paginateCount = count(Order::all()) / 5;
      $items = Order::select(['id', 'created_at', 'user_id', 'final_amount', 'status', 'payment_status'])
         ->with(['user:id,username'])
         ->orderBy('id', 'DESC')
         ->paginate(5);
      return response()->json([$paginateCount, $items]);
   }


   public function showWithRels(int $id)
   {
      $data = Order::select(['id', 'user_id', 'final_amount', 'created_at'])
         ->with(['order_items.product.media', 'user.media:id,mediable_id,mediable_type,name'])
         ->find($id);
      return response()->json($data);
   }


   public function lastOrder()
   {
      $user_id = auth()->user()->id;
      $order = Order::where('user_id', $user_id)->orderBy('id', 'DESC')->limit(1)->first();

      $data = [
         'merchant_id' => env('MERCHANT_ID'),
         'amount' => $order->final_amount,
         'description' => 'خرید محصول',
         'callback_url' => 'http://localhost:5173/store/shopping-payment',
      ];


      try {
         $client = new Client();
         $response = $client->post('https://api.zarinpal.com/pg/v4/payment/request.json', [
            'json' => $data,
         ]);
         $result = json_decode($response->getBody(), true);
         return $result;
         //    if ($result['data']['code'] == 0) {
         //          // هدایت کاربر به صفحه پرداخت زرین‌پال
         //          return redirect()->away('https://www.zarinpal.com/pg/StartPay/' . $result['data']['authority']);
         //      }
         // return response()->json(['error' => 'خطا در ایجاد درخواست پرداخت'], 500);
      } catch (\Exception $e) {
         return response()->json(['error' => 'ارتباط با زرین‌پال برقرار نشد'], 500);
      }
   }
}
