<?php

// app/Http/Controllers/EpochController.php

namespace App\Http\Controllers;

use App\Models\Epoch;

class EpochController extends Controller
{
    public function index() {
        $epochs = Epoch::all();
        return view('epochs.show', compact('epochs'));
    }

    public function show(Epoch $epoch) {
        return view('epochs.detail', compact('epoch'));
    }
}