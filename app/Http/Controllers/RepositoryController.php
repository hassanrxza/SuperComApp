<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{

    public function getRepos()
    {
        $token = Auth::user()->github_token;
        $client = new Client();

        $response =  $client->request('GET', 'https://api.github.com/user/repos', [
            'headers' => [
                'Authorization' => "token $token",
                'Accept' => 'application/vnd.github.v3+json',
            ]]);

        if ($response->getStatusCode() == 200) {
            return json_decode($response->getBody()->getContents(), true);
        }

        else {
            throw new \Exception('Failed to fetch repositories');
        }


    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check())
        {
            $user = Auth::user();

            try {
                $repo = collect($this->getRepos());
            }
            catch (\Exception) {
                dd("Cannot fetch repositories");
            }

            $perPage = 10;
            $currentPage = request('page', 1);
            $pagedRepo = new Paginator($repo->forPage($currentPage, $perPage), $perPage);

            return view('dashboard', compact('user', 'pagedRepo'));
        }
        else
        {
            return redirect('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
