<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'title' => 'AL',
                'description' => 'Alabama',

            ],
            [
                'title' => 'AK',
                'description' => 'Alaska',

            ],
            [
                'title' => 'AS',
                'description' => 'American Samoa',

            ],
            [
                'title' => 'AZ',
                'description' => 'Arizona',

            ],
            [
                'title' => 'AR',
                'description' => 'Arkansas',

            ],
            [
                'title' => 'CA',
                'description' => 'California',

            ],
            [
                'title' => 'CO',
                'description' => 'Colorado',

            ],
            [
                'title' => 'CT',
                'description' => 'Connecticut',

            ],
            [
                'title' => 'DE',
                'description' => 'Delaware',

            ],
            [
                'title' => 'DC',
                'description' => 'District Of Columbia',

            ],
            [
                'title' => 'FM',
                'description' => 'Federated States Of Micronesia',

            ],
            [
                'title' => 'FL',
                'description' => 'Florida',

            ],
            [
                'title' => 'GA',
                'description' => 'Georgia',

            ],
            [
                'title' => 'GU',
                'description' => 'Guam',

            ],
            [
                'title' => 'HI',
                'description' => 'Hawaii',

            ],
            [
                'title' => 'ID',
                'description' => 'Idaho',

            ],
            [
                'title' => 'IL',
                'description' => 'Illinois',

            ],
            [
                'title' => 'IN',
                'description' => 'Indiana',

            ],
            [
                'title' => 'IA',
                'description' => 'Iowa',

            ],
            [
                'title' => 'KS',
                'description' => 'Kansas',

            ],
            [
                'title' => 'KY',
                'description' => 'Kentucky',

            ],
            [
                'title' => 'LA',
                'description' => 'Louisiana',

            ],
            [
                'title' => 'ME',
                'description' => 'Maine',

            ],
            [
                'title' => 'MH',
                'description' => 'Marshall Islands',

            ],
            [
                'title' => 'MD',
                'description' => 'Maryland',

            ],
            [
                'title' => 'MA',
                'description' => 'Massachusetts',

            ],
            [
                'title' => 'MI',
                'description' => 'Michigan',

            ],
            [
                'title' => 'MN',
                'description' => 'Minnesota',

            ],
            [
                'title' => 'MS',
                'description' => 'Mississippi',

            ],
            [
                'title' => 'MO',
                'description' => 'Missouri',

            ],
            [
                'title' => 'MT',
                'description' => 'Montana',

            ],
            [
                'title' => 'NE',
                'description' => 'Nebraska',

            ],
            [
                'title' => 'NV',
                'description' => 'Nevada',

            ],
            [
                'title' => 'NH',
                'description' => 'New Hampshire',

            ],
            [
                'title' => 'NJ',
                'description' => 'New Jersey',

            ],
            [
                'title' => 'NM',
                'description' => 'New Mexico',

            ],
            [
                'title' => 'NY',
                'description' => 'New York',

            ],
            [
                'title' => 'NC',
                'description' => 'North Carolina',

            ],
            [
                'title' => 'ND',
                'description' => 'North Dakota',

            ],
            [
                'title' => 'MP',
                'description' => 'Northern Mariana Islands',

            ],
            [
                'title' => 'OH',
                'description' => 'Ohio',

            ],
            [
                'title' => 'OK',
                'description' => 'Oklahoma',

            ],
            [
                'title' => 'OR',
                'description' => 'Oregon',

            ],
            [
                'title' => 'PW',
                'description' => 'Palau',

            ],
            [
                'title' => 'PA',
                'description' => 'Pennsylvania',

            ],
            [
                'title' => 'PR',
                'description' => 'Puerto Rico',

            ],
            [
                'title' => 'RI',
                'description' => 'Rhode Island',

            ],
            [
                'title' => 'SC',
                'description' => 'South Carolina',

            ],
            [
                'title' => 'SD',
                'description' => 'South Dakota',

            ],
            [
                'title' => 'TN',
                'description' => 'Tennessee',

            ],
            [
                'title' => 'TX',
                'description' => 'Texas',

            ],
            [
                'title' => 'UT',
                'description' => 'Utah',

            ],
            [
                'title' => 'VT',
                'description' => 'Vermont',

            ],
            [
                'title' => 'VI',
                'description' => 'Virgin Islands',

            ],
            [
                'title' => 'VA',
                'description' => 'Virginia',

            ],
            [
                'title' => 'WA',
                'description' => 'Washington',

            ],
            [
                'title' => 'WV',
                'description' => 'West Virginia',

            ],
            [
                'title' => 'WI',
                'description' => 'Wisconsin',

            ],
            [
                'title' => 'WY',
                'description' => 'Wyoming',

            ]
        ];

        foreach ($states as $state) {
            DB::table('states')->insert($state);
        }
    }
}
