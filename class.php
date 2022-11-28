<?

class Player {
    public $name;
    public $coins;

    public function __construct($name, $coins)
    {
        $this->name = $name;
        $this->coins = $coins;
    }
    public function point(Player $player) {
        $this->coins++;
        $player->coins--;
    }
    public function bankrot() {
        return $this->coins == 0;
    }
    public function odds(Player $player) {
        return round($this->coins / ($this->coins + $player->coins), 2) * 100 . '%';
    }

}

class Game {
    protected $player1;
    protected $player2;

    protected $flips = 1;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }
    public function flip() {
        return rand(0,1) ? 'орел' : 'решка';
    }
    public function start() {
        echo 'Игра началась.';
        echo '<br>Шансы: '. $this->player1->odds($this->player2);
        echo '<br>Шансы: '. $this->player2->odds($this->player1);

        $this->play();
    }
    public function play() {
        while(true) {
            if($this->flip() == 'орел') {
                $this->player1->point($this->player2);
            } else {
                $this->player2->point($this->player1);
            }
            if($this->player1->bankrot() || $this->player2->bankrot()) {
                return $this->end();
            }
            $this->flips++;
        }
    }

    public function winner() {
        return $this->player1->coins > $this->player2->coins ? $this->player1->name : $this->player2->name;
    }

    public function end() {
        echo '<br>game over, winner '.$this->winner(). '<br>count flips '.$this->flips;
    }
}