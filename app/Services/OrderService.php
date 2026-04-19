<?php

namespace App\Services;

use App\Models\Address;
use App\Models\User;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class OrderService
{
    public function __construct(
        readonly protected ProductRepositoryInterface $product_repository,
        readonly protected OrderRepositoryInterface $order_repository,
    ) {}


    public function allWithRelations()
    {
        return $this->order_repository->allOrdersWithRelations();
    }



    public function createWithRel($data)
    {
        try {

            DB::beginTransaction();

            $user = User::findOrFail($data['user_id']);
            $address = $user->address->with(['province', 'city'])->first();
            $cart = $data['cart'];
            $shipping_method = $data['shipping_method'];
            if($shipping_method === 'post' || $shipping_method === 'tipax'){
                $shipping_cost = 100000;
            }else{
                $shipping_cost = 0;
            }
            $totalPrice = 0;
            foreach ($cart as $product) {
                $productPrice = $this->product_repository->find($product['id'])->price;
                $totalPrice += $product["count"] * $productPrice;
            };
            $packing_cost = 0;
            $tax_amount = round($totalPrice * 0.09);
            $final_amount = $totalPrice + $tax_amount + $packing_cost + $shipping_cost ;

            $order = [
                'user_id' => $user->id,
                'order_number' => 'ORD-' . Str::ulid(),
                'status' => 'pending',
                'total_amount' => $totalPrice,
                'discount_amount' => 0,
                'tax_amount' => $tax_amount,
                'packing_cost' => $packing_cost,
                'shipping_cost' => $shipping_cost,
                'final_amount' => $final_amount,
                'shipping_method' => $shipping_method,
                'shipping_province' => $address->province->name,
                'shipping_city' => $address->city->name,
                'shipping_postal_code' => $address->postal_code,
                'shipping_address' => $address->address,
                'payment_status' => 'unpaid',
                'payment_method' => 'online',
            ];

            $createdOrder = $this->order_repository->create($order);
             
            $allOrderItems = [];
            foreach($cart as $product){
                $productPrice = $this->product_repository->find($product['id'])->price;
                $allOrderItems[] = [
                    'order_id' => $createdOrder->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['count'],
                    'price' => $productPrice,
                    'total_price' => $productPrice * $product['count'],
                ] ;
            }

            $createdOrder->order_items()->createMany($allOrderItems);

            DB::commit();

            return response()->json('created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage());
        }
    }





    public function userInfo(array $user, array $address, int $id)
    {
        try {
            $targetUser = User::find($id);
            if (!$targetUser) return response()->json(['error' => 'کاربر یافت نشد']);
            $targetUser->update($user);
            if (isset($targetUser?->address)) {
                $updatedAddress = $targetUser->address->update($address);
                return response()->json($updatedAddress);
            } else {
                $createdAddress = Address::create($address);
                return response()->json($createdAddress);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }




    public function showWithRels(int $id)
    {
        return $this->order_repository->showWithRels($id);
    }



    public function lastOrder()
    {
        $order = $this->order_repository->lastOrder();
        return response()->json($order);

    }



    public function deleteOrderWithRels(int $id)
    {
        $findOrder = $this->order_repository->find($id);
        foreach($findOrder->order_items as $item){
            $item->delete();
        };
        return $this->order_repository->delete($id);
    }


}
