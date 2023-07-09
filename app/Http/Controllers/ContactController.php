<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Faker\Factory as Faker;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'required|numeric|min:11|unique:contacts,phone|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        try {
            Contact::create($validatedData);
            return response()->json(['message' => 'The contact has been created successfully!']);
        } catch (ValidationException $e) {
            $errorMessage = $e->validator->errors()->first();
            return response()->json(['error' => $errorMessage], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create contact. Unknown error occurred.'], 500);
        }
    }

    /**
     * Generate 500 random contacts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateRandomContacts(Request $request)
    {
        $faker = Faker::create('en_GB');

        $contacts = [];

        for ($i = 0; $i < 500; $i++) {
            $uniqueEmail = $faker->unique()->safeEmail;
            $uniquePhone = $faker->unique()->regexify('^07\d{9}$');

            while (Contact::where('email', $uniqueEmail)->orWhere('phone', $uniquePhone)->exists()) {
                $uniqueEmail = $faker->unique()->safeEmail;
                $uniquePhone = $faker->unique()->regexify('^07\d{9}$');
            }

            $contacts[] = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $uniqueEmail,
                'phone' => $uniquePhone,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Contact::insert($contacts);

        return response()->json(['message' => 'Random contacts created successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }
}
