<?php

namespace App\Http\Controllers;

use App\Actions\GetUsers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(Request $request, GetUsers $getUsers): Response
    {
        return Inertia::render('Dashboard', $getUsers->fetch());
    }
}
