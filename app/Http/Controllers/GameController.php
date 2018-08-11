<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as RequestFacades;
use Illuminate\Support\Facades\Auth;
use App\Bank;
use App\PlayerStat;

class GameController extends Controller
{    
    public function __construct() {
        
    }    

    public function generateRandomWords(Request $request) {
        if (Auth::check()) {
            $ps = PlayerStat::join('users', 'player_stats.user_id', '=', 'users.id')
                                ->select('player_stats.*', 'users.email')
                                ->where('player_stats.user_id', '=', Auth::user()->id)
                                ->get();
            
            foreach($ps as $item) {}
            $stats = !empty($item) ? json_decode($item) : new stdClass();
        }        

        $current_level = $stats->current_level ?? session('current_level') ?? 1;
        $current_level_words = $stats->current_level_words ?? session('current_level_words') ?? [];

        if (empty(session('banks'))) {
            $banks = Bank::select('word', 'level')
                        ->where('level', '=', $current_level)
                        ->whereNotIn('word', $current_level_words)
                        ->get();
    
            foreach($banks as $bank) {
                $item = json_decode($bank);
                $words[] = $item->word;
            }

            $request->session()->put('banks', $words);
        } else {
            $words = array_values(session('banks'));            
        }

        $random_word = $words[ random_int(0, (count($words)-1)) ];
        $request->session()->flash('current_active_word', $random_word);
        $request->session()->put('current_level', $current_level);

        if ($request->session()->has('current_level_words')) {
            $request->session()->push('current_level_words', $random_word);
        } else {
            $request->session()->put('current_level_words', [ $random_word ]);
        }

        $params = $this->shuffleWord($random_word);

        echo json_encode($params);
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

        echo json_encode( $response );
    }

    public function checkAnswer(Request $request) {
        $current_active_word = session('current_active_word');
        $messages = '';
        $words = session('banks');
        
        if ($request->guess_word === $current_active_word) {
            $messages = 'Correct! Congratulations!';

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
                $messages = 'Level ' . session('current_level');
            }

        } else {
            $messages = 'Incorrect!';
            $request->session()->keep(['current_active_word']);
        }

        if (Auth::check()) {
            $this->saveLoggedinPlayerSession();
        } else {
            $this->saveGuestPlayerSession();
        }

        echo self::templResponse($messages);
    }

    private function saveLoggedinPlayerSession() {
        
    }

    private function saveGuestPlayerSession() {
        
    }

    private static function templResponse($messages="", $status="OK", $http_status_code=200) {
        return json_encode([
            "code" => $http_status_code,
            "status" => $status,
            "message" => $messages
        ], $http_status_code);
    }
}
