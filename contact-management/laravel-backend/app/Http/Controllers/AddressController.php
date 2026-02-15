<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AddressResource;
use App\Http\Requests\AddressCreateRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\Address;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddressController extends Controller
{
    private function getContact($contact_id)
    {
        try {
            $user = Auth::user();
            return Contact::where('user_id', $user->id)
                ->where('id', $contact_id)->firstOrFail();
        } catch (\Throwable $th) {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ['Not found']
                ]
            ], 404));
        }
    }

    private function getAddress($address_id, $contact_id)
    {
        try {
            return Address::where('id', $address_id)
                ->where('contact_id', $contact_id)
                ->firstOrFail();
        } catch (\Throwable $th) {
            throw new HttpResponseException(response([
                'errors' => [
                    'message' => ['Not found']
                ]
            ], 404));
        }
    }

    public function index($id)
    {
        $contact = $this->getContact($id);
        $address = $contact->addresses()->get();
        return AddressResource::collection($address);
    }

    public function get($contact_id, $address_id)
    {
        $contact = $this->getContact($contact_id);
        $address = $this->getAddress($address_id, $contact->id);
        return new AddressResource($address);
    }

    public function create($id, AddressCreateRequest $request)
    {
        $data = $request->validated();
        $contact = $this->getContact($id);
        $address = $contact->addresses()->create($data);
        return new AddressResource($address)
            ->response()->setStatusCode(201);
    }

    public function update($contact_id, $address_id, AddressUpdateRequest $request)
    {
        $data = $request->validated();
        $contact = $this->getContact($contact_id);
        $address = $this->getAddress($address_id, $contact->id);
        $address->update($data);
        return new AddressResource($address);
    }

    public function delete($contact_id, $address_id)
    {
        $contact = $this->getContact($contact_id);
        $address = $this->getAddress($address_id, $contact->id);
        $address->delete();
        return response()->json([
            'data' => true
        ]);
    }
}
