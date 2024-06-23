<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Factory;

class FirebaseController extends Controller
{
    protected $collectionName = 'contacts';
    protected function firestore()
    {
        return (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->createFirestore();
    }

    public function index()
    {
        try {
            $data = $this->firestore()->database()->collection($this->collectionName)->documents();
            $contacts = [];

            foreach ($data as $document) {


                $createdAt = $document->data()['created_at'];
                $createdAt = Carbon::parse($createdAt)->format('Y-m-d H:i:s');

                $updatedAt = $document->data()['updated_at'];
                $updatedAt = Carbon::parse($updatedAt)->format('Y-m-d H:i:s');

                $contacts[] = (object) [
                    'id' => $document->id(),
                    'name' => $document->data()['name'],
                    'email' => $document->data()['email'],
                    'phone' => $document->data()['phone'],
                    'message' => $document->data()['message'] ?? '',
                    'created_at' => $createdAt,
                    'updated_at' => $updatedAt,
                ];
            }

            $contacts = (object) $contacts;
            return view('contact.index', compact('contacts'));

        } catch (FirebaseException $e) {
            dd('Error fetching data: ', $e->getMessage());
        }
    }

    // Add the following method to the FirebaseController class:
    public function store(Request $request)
    {
        try {

            $timestamp = new \DateTime('now');
            $this->firestore()->database()->collection($this->collectionName)->add([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message ?? null,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ]);

            return redirect()->route('index')->with('success', 'Data added successfully');
        } catch (FirebaseException $e) {
            return redirect()->route('index')->with('error', 'Error adding data: ' . $e->getMessage());
        }
    }

    // Add the following method to the FirebaseController class:
    public function update(Request $request, $id)
    {
        try {
            $timestamp = new \DateTime('now');
            $this->firestore()->database()->collection($this->collectionName)->document($id)->set([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message ?? null,
                'updated_at' => $timestamp,
            ], ['merge' => true]);

            return redirect()->route('index')->with('success', 'Data updated successfully');
        } catch (FirebaseException $e) {
            return redirect()->route('index')->with('error', 'Error updating data: ' . $e->getMessage());
        }
    }

    // Add the following method to the FirebaseController class:
    public function destroy($id)
    {
        try {
            $this->firestore()->database()->collection($this->collectionName)->document($id)->delete();

            return redirect()->route('index')->with('success', 'Data deleted successfully');
        } catch (FirebaseException $e) {
            return redirect()->route('index')->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }

    // Add the following method to the FirebaseController class:
    public function show($id)
    {
        try {
            $data = $this->firestore()->database()->collection($this->collectionName)->document($id)->snapshot();

            return view('show', compact('data'));
        } catch (FirebaseException $e) {
            return redirect()->route('index')->with('error', 'Error fetching data: ' . $e->getMessage());
        }
    }

    // Add the following method to the FirebaseController class:
    public function edit($id)
    {
        try {
            $data = $this->firestore()->database()->collection($this->collectionName)->document($id)->snapshot();

            $contact = [
                'id' => $data->id(),
                'name' => $data->data()['name'],
                'email' => $data->data()['email'],
                'phone' => $data->data()['phone'],
                'message' => $data->data()['message'] ?? '',
            ];

            $contact = (object) $contact;

            return view('contact.edit-form', compact('contact'));
        } catch (FirebaseException $e) {
            return redirect()->route('index')->with('error', 'Error fetching data: ' . $e->getMessage());
        }
    }

    // Add the following method to the FirebaseController class:
    public function create()
    {
        return view('contact.create-form');
    }
}
