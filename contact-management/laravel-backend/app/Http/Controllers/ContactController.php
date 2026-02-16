<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ContactResource;
use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactController extends Controller
{
    public function create(ContactCreateRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $contact = Contact::create($data);

        return new ContactResource($contact)->response()->setStatusCode(201);
    }

    public function get($id)
    {
        try {
            $user = Auth::user();
            $contact = Contact::where('user_id', $user->id)->where('id', $id)->firstOrFail();
            return new ContactResource($contact);
        } catch (\Throwable $th) {
            throw new HttpResponseException(
                response([
                    'errors' => [
                        'message' => ['Contact not found']
                    ]
                ], 404)
            );
        }
    }

    public function search(Request $request)
    {
        try {
            $user = Auth::user();
            $size = $request->query('size', 10);
            $page = $request->query('page', 1);
            $name = $request->query('name');
            $phone = $request->query('phone');
            $email = $request->query('email');
            $contact = Contact::where('user_id', $user->id)
                ->when($name, function ($query) use ($name) {
                    $query
                        ->whereLike('first_name', "%$name%")
                        ->orWhereLike('last_name', "%$name%");
                })
                ->when($phone, function ($query) use ($phone) {
                    $query->where('phone', $phone);
                })
                ->when($email, function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->paginate(perPage: $size, page: $page);
            return ContactResource::collection($contact);
        } catch (\Throwable $th) {
            throw new HttpResponseException(
                response([
                    'errors' => [
                        'message' => ['Contact not found']
                    ]
                ], 404)
            );
        }
    }

    public function update($id, ContactUpdateRequest $request)
    {
        try {
            $data = $request->validated();
            $user = Auth::user();
            $contact = Contact::where('user_id', $user->id)
                ->where('id', $id)
                ->firstOrFail();
            $contact->update($data);
            return new ContactResource($contact);
        } catch (\Throwable $th) {
            throw new HttpResponseException(
                response([
                    'errors' => [
                        'message' => ['Contact not found']
                    ]
                ], 404)
            );
        }
    }

    public function delete($id)
    {
        try {
            $user = Auth::user();
            $contact = Contact::where('user_id', $user->id)
                ->where('id', $id)
                ->firstOrFail();
            $contact->delete();
            return response()->json([
                'data' => true
            ]);
        } catch (\Throwable $th) {
            throw new HttpResponseException(
                response([
                    'errors' => [
                        'message' => ['Contact not found']
                    ]
                ], 404)
            );
        }
    }
}
