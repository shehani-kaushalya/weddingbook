<?php

namespace App\Services;

use App\CustomerAddress;
use Illuminate\Support\Facades\Auth;

class CustomerAddressService
{
    public function createCustomerAddress(array $data, $type)
    {

        return CustomerAddress::create([
            'cust_id' => $data['id'],
            'name' => $data['custName'],
            'street_address' => $data['streetAddress'],
            'street_address2' => $data['streetAddress1'],
            'street_address3' => $data['streetAddress3'],
            'city' => $data['city'],
            'state' => $data['state'],
            'postal_code' => $data['zipcode'],
            'is_primary' => $type,
            'status' => CustomerAddress::ACTIVE,
        ]);
    }

    public function getAllCustomerAddresses($id)
    {
        $address = CustomerAddress::where('cust_id', $id)->orderBy('is_primary', 'DESC')->get();
        return $address;
    }

    public function getCustomerAddressesCount($id)
    {
        $address = CustomerAddress::where('cust_id', $id)->get();
        $addressCount = $address->count();
        return $addressCount;
    }

    public function getSelectedAddress($id)
    {
        $addressData = CustomerAddress::where('id', $id)->orderBy('is_primary', 'ASC')->get();
        return $addressData;
    }

    public function setCurrentAddressPrimary($id)
    {
        $user = CustomerAddress::join('customer_address', 'customer_address.cust_id', '=', 'users.id')
            ->select('users.*')
            ->get();
    }

    public function updateAddressesType($addressCustomerData, $addressId)
    {
        foreach ($addressCustomerData as $addressData) {
            if ($addressData->id == $addressId) {
                CustomerAddress::where('id', $addressId)->update(['is_primary' => 1]);
            } else {
                CustomerAddress::where('id', $addressData->id)->update(['is_primary' => 0]);
            }

        }

        return true;

    }

    public function updateCustomerAddress($id, $data)
    {
        if ($data['is_primary'] == CustomerAddress::PRIMARY) {
            CustomerAddress::where([['cust_id', Auth::user()->id], ['is_primary', CustomerAddress::PRIMARY]])->update(['is_primary' => CustomerAddress::NORMAL]);
        } else {
            $currentType = CustomerAddress::where([['cust_id', Auth::user()->id], ['id', $id]])->first();
            if ($currentType->is_primary == CustomerAddress::PRIMARY) {
                $data['is_primary'] = CustomerAddress::PRIMARY;
            }

        }
        $address = CustomerAddress::where([['cust_id', Auth::user()->id], ['id', $id]])->update($data);
        return $address;
    }

}
