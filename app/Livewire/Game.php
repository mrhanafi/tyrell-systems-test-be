<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Game extends Component
{
     public $peopleCount;
    public $results = [];
    public $distribution = [];
    public $error = '';

    public function distributeCardss()
    {
        $this->error = '';
        $this->results = [];
        $this->distribution = [];

        // Validation
        if (is_null($this->peopleCount) || !is_numeric($this->peopleCount) || $this->peopleCount < 1) {
            $this->error = "Input value does not exist or value is invalid";
            return;
        }

        // Prepare 52 cards
        $suits = ['S', 'H', 'D', 'C'];
        $ranks = [1 => 'A', 2, 3, 4, 5, 6, 7, 8, 9, 10 => 'X', 11 => 'J', 12 => 'Q', 13 => 'K'];
        $deck = [];

        foreach ($suits as $suit) {
            foreach ($ranks as $num => $rank) {
                $deck[] = "$suit-$rank";
            }
        }

        shuffle($deck);

        $this->distribution = array_fill(0, $this->peopleCount, []);

        // Distribute cards round-robin
        foreach ($deck as $i => $card) {
            $this->distribution[$i % $this->peopleCount][] = $card;
        }

        // Prepare output
        foreach ($this->distribution as $hand) {
            $this->results[] = implode(',', $hand);
        }
    }
    public function render()
    {
        return view('livewire.game');
    }
}
