<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
            ['word' => 'fuzz'],['word' => 'best'],['word' => 'jazz'],['word' => 'host'],['word' => 'hajj'],
            ['word' => 'drag'],['word' => 'drop'],['word' => 'tick'],['word' => 'crap'],['word' => 'trap'],
            ['word' => 'flop'],['word' => 'pack'],['word' => 'take'],['word' => 'hide'],['word' => 'hype'],
            ['word' => 'soak'],['word' => 'seed'],['word' => 'leaf'],['word' => 'trip'],['word' => 'bold'],
            ['word' => 'ship'],['word' => 'loan'],['word' => 'soap'],['word' => 'flip'],['word' => 'peer'],

            ['word' => 'black'],['word' => 'flyer'],['word' => 'grape'],['word' => 'fruit'],['word' => 'track'],
            ['word' => 'freak'],['word' => 'drawn'],['word' => 'score'],['word' => 'plate'],['word' => 'trafo'],
            ['word' => 'sword'],['word' => 'torch'],['word' => 'peace'],['word' => 'speed'],['word' => 'smart'],
            ['word' => 'heart'],['word' => 'snake'],['word' => 'green'],['word' => 'place'],['word' => 'trace'],
            ['word' => 'train'],['word' => 'ruler'],['word' => 'wheel'],['word' => 'metre'],['word' => 'blend'],
            
            ['word' => 'puzzle'],['word' => 'zigzag'],['word' => 'summer'],['word' => 'insect'],['word' => 'doctor'],
            ['word' => 'dagger'],['word' => 'father'],['word' => 'random'],['word' => 'flight'],['word' => 'travel'],
            ['word' => 'middle'],['word' => 'hammer'],['word' => 'factor'],['word' => 'layout'],['word' => 'public'],
            ['word' => 'drawer'],['word' => 'soccer'],['word' => 'basket'],['word' => 'kernel'],['word' => 'dinner'],
            ['word' => 'clever'],['word' => 'though'],['word' => 'teaser'],['word' => 'toilet'],['word' => 'pocket'],

            ['word' => 'migrate'],['word' => 'hacksaw'],['word' => 'grammar'],['word' => 'hostile'],['word' => 'tracker'],
            ['word' => 'empathy'],['word' => 'drawing'],['word' => 'thinker'],['word' => 'clipper'],['word' => 'booster'],
            ['word' => 'feature'],['word' => 'feather'],['word' => 'crafter'],['word' => 'doctor'],['word' => 'smaller'],
            ['word' => 'pinguin'],['word' => 'husband'],['word' => 'storage'],['word' => 'toddler'],['word' => 'reciter'],
            ['word' => 'charger'],['word' => 'library'],['word' => 'traffic'],['word' => 'dynamic'],['word' => 'machine'],

            ['word' => 'employer'],['word' => 'isolator'],['word' => 'progress'],['word' => 'provider'],['word' => 'keyboard'],
            ['word' => 'football'],['word' => 'baseball'],['word' => 'notebook'],['word' => 'religion'],['word' => 'bathroom'],
            ['word' => 'magazine'],['word' => 'airplane'],['word' => 'delivery'],['word' => 'capacity'],['word' => 'quantity'],
            ['word' => 'spectrum'],['word' => 'medicine'],['word' => 'maintain'],['word' => 'mountain'],['word' => 'relative'],
            ['word' => 'quantity'],['word' => 'envelope'],['word' => 'reliable'],['word' => 'frontier'],['word' => 'superman'],

            ['word' => 'innovator'],['word' => 'astronout'],['word' => 'milkshake'],['word' => 'emphasize'],['word' => 'incubator'],
            ['word' => 'photoshop'],['word' => 'heterogen'],['word' => 'dilligent'],['word' => 'handover'],['word' => 'phonebook'],
            ['word' => 'cellphone'],['word' => 'tetralogy'],['word' => 'quadraple'],['word' => 'hexagonal'],['word' => 'community'],
            ['word' => 'dashboard'],['word' => 'foreigner'],['word' => 'ultimatum'],['word' => 'education'],['word' => 'alphabeth'],
            ['word' => 'billboard'],['word' => 'microsoft'],['word' => 'brainware'],['word' => 'maternity'],['word' => 'developer'],

            ['word' => 'toothbrush'],['word' => 'theraphyst'],['word' => 'dinosaurus'],['word' => 'maintainer'],['word' => 'microphone'],
            ['word' => 'antiseptic'],['word' => 'programmer'],['word' => 'cryptogram'],['word' => 'supervisor'],['word' => 'philosophy'],
            ['word' => 'chronology'],['word' => 'investment'],

            ['word' => 'equilibrium'],['word' => 'investation'],['word' => 'portability'],['word' => 'development']
        ]);
    }
}
