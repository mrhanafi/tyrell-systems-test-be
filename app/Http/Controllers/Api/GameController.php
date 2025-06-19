<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function distribute(Request $request)
    {
        // declare input request
        $peopleCount = $request->input('peopleCount');

        // Error handling
        if (is_null($peopleCount) || !is_numeric($peopleCount) || $peopleCount < 0) {
            return response()->json([
                'error' => 'Input value does not exist or value is invalid'
            ], 400);
        }

        // Prepare deck
        $suits = ['S', 'H', 'D', 'C'];
        $ranks = [1 => 'A', 2, 3, 4, 5, 6, 7, 8, 9, 10 => 'X', 11 => 'J', 12 => 'Q', 13 => 'K'];
        $deck = [];

        foreach ($suits as $suit) {
            foreach ($ranks as $num => $rank) {
                $deck[] = "$suit-$rank";
            }
        }

        shuffle($deck);

        // set array in distribution based on peopleCount
        $distribution = array_fill(0, $peopleCount, []);

        // Distribute cards round-robin
        foreach ($deck as $i => $card) {
            $distribution[$i % $peopleCount][] = $card;
        }

        // Format response
        $results = array_map(function ($hand) {
            return implode(',', $hand);
        }, $distribution);

        return response()->json([
            'cards' => $distribution,
            'results' => $results,
        ]);
    }
}
