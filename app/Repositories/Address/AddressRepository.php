<?php

namespace App\Repositories\Address;
use App\Models\Address;
use App\Repositories\BaseRepository;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
 public function __construct(Address $address)
 {
     parent::__construct($address);
 }
}
