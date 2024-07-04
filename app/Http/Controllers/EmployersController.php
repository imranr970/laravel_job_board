<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;

class EmployersController extends Controller
{

    public function __construct() 
    {
        $this->authorizeResource(Employer::class);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Employers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->user()->employer()->create(
            
            $request->validate([
                'company_name' => 'required|min:3|unique:employers,company_name'
            ])

        );

        return redirect()->route('jobs.index')
            ->with('success', 'Your employer account was created!');

    }

}
