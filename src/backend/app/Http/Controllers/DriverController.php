<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function show(Request $request) {
        $user = $request->user();
        $user->load('driver');

        return $user;
    }

    public function update(Request $request) {
        $request->validate([
            'year' => 'required|numeric|between:1900,2024',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'color' => 'required|alpha|max:255',
            'name' => 'required|string|max:255',
        ]);

        $user = $request->user();
        $user->update($request->only('name'));

        $user->driver()->updateOrCreate($request->only([
            'year',
            'make',
            'model',
            'license_plate',
            'color',
        ]));

        $user->load('driver');

        return $user;
    }
}
