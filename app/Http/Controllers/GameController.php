<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacades;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Handler;
use App\Bank;
use App\PlayerStat;
use App\Repositories\BankRepository;
use App\Repositories\PlayerStatsRepository;

class GameController extends Controller
{    
    protected $playerstats;
    protected $bank;

    public function __construct(Bank $bank, PlayerStat $playerstats) {
        $this->playerstats = new PlayerStatsRepository($playerstats);
        $this->bank = new BankRepository($bank);
    }    

    public function generateRandomWords(Request $request) {        
        if (Auth::check()) {
            $ps = $this->playerstats->show(Auth::user()->id);
            
            foreach($ps as $item) {}
            $stats = !empty($item) ? json_decode($item) : new stdClass();
        }        

        $current_level = $stats->current_level ?? session('current_level') ?? 1;
        $current_level_words = $stats->current_level_words ?? session('current_level_words') ?? [];

        if (empty(session('banks'))) {
            $banks = $this->bank->getWordsByLevel($current_level, $current_level_words);
    
            foreach($banks as $bank) {
                $item = json_decode($bank);
                $words[] = $item->word;
            }

            $request->session()->put('banks', $words);
        } else {
            $words = array_values(session('banks'));            
        }

        // print_r(session('banks')); exit;

        $random_word = $words[ random_int(0, (count($words)-1)) ];
        $request->session()->flash('current_active_word', $random_word);
        $request->session()->put('current_level', $current_level);

        if ($request->session()->has('current_level_words')) {
            $request->session()->push('current_level_words', $random_word);
        } else {
            $request->session()->put('current_level_words', [ $random_word ]);
        }

        $params = $this->shuffleWord($random_word);

        echo response($params)->getContent();
    }

    private function shuffleWord($guess_word=null) {
        $str_to_array = str_split($guess_word);
        $secret_str = str_split(session('current_active_word'));        
        shuffle($str_to_array);
    
        return [
            'words' => $str_to_array === $secret_str ? shuffle($str_to_array) : $str_to_array
        ];
    }

    public function reShuffle(Request $request) {        
        $response = $this->shuffleWord( session('current_active_word') );
        $request->session()->keep(['current_active_word']);

        echo response($response)->getContent();
    }

    public function checkAnswer(Request $request) {
        try {
            $current_active_word = session('current_active_word');
            $messages = [];
            $words = session('banks');
            
            if ($request->guess_word === $current_active_word) {
                $messages[] = 'Your answer is Correct! Congratulations!';

                /**
                 * Validation
                 * If user made a corrects answer, then pop-out temporary banks of array
                 */
                
                $word_key = array_keys($words, $current_active_word);
                
                if (count($word_key)>0) {
                    unset($words[ $word_key[0] ]);                
                }

                if (count($words) > 0) {
                    $request->session()->put('banks', $words);                
                } else {
                    $request->session()->forget('banks');
                    $request->session()->forget('current_level_words');
                    
                    $request->session()->put('current_level', intval(session('current_level') + 1));
                    $messages[] = 'Congratulations! You\'ve reached Level ' . session('current_level') . '!';
                }

            } else {
                $messages[] = 'Your answer is Incorrect!';
                $request->session()->keep(['current_active_word']);
            }

            if (Auth::check()) {
                $this->saveLoggedinPlayerSession();
            } else {
                $this->saveGuestPlayerSession();
            }

            self::templResponse($messages);
        } catch(Exception $e) {
            self::templResponse($e->getMessage(), "ERROR", $e->getCode());
        }        
    }

    private function saveLoggedinPlayerSession() {
        
    }

    private function saveGuestPlayerSession() {
        
    }

    public function refreshTheGame(Request $request) {
        try {
            $request->session()->forget('banks');        
            $request->session()->forget('current_active_word');
            $request->session()->forget('current_level_words');
            $request->session()->forget('current_level');            

            self::templResponse("Refreshing game success!");
        } catch(Exception $e) {
            self::templResponse($e->getMessage(), "ERROR", $e->getCode());
        }
        
    }

    private static function templResponse($messages="", $status="OK", $http_status_code=200) {
        echo response([
            "code" => $http_status_code,
            "status" => $status,
            "message" => $messages
        ], $http_status_code)->getContent();
    }

    public function invalidRoute() {
        self::templResponse("Invalid Route", "ERROR", 404);
    }
}
