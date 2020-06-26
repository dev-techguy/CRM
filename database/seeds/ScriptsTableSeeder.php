<?php

use App\Script;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScriptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scripts = [
            // TODO Q1
            [
                'question' => 'My Name is Cynthia Calling you from ABC, could I
speak to',
                'answers' => json_encode([
                    'yes' => 'YES',
                    'no' => 'NO',
                ]),
                'next_question' => json_encode([
                    'yes' => 3,
                    'no' => 2,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q2
            [
                'question' => 'at some other date and time?',
                'answers' => json_encode([
                    'yes' => 'YES',
                    'no' => 'NO',
                ]),
                'next_question' => json_encode([
                    'yes' => 'Capture date and time for the next call.',
                    'no' => 'Get dispositions',
                ]),
                'dispositions' => json_encode([
                    '1' => 'Number doesn’t belong to the customer.',
                    '2' => 'Not Interested.',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],// TODO Q3
            [
                'question' => 'Its about ABC and the benefits your company can acquire from us working together. Which is
offering a solution that will significantly reduce your IT infrastructure costs while ensuring reliability and
enhanced security through the services we offer. Are you interested?',
                'answers' => json_encode([
                    'yes' => 'YES',
                    'no' => 'NO',
                ]),
                'next_question' => json_encode([
                    'yes' => 4,
                    'no' => 'Get dispositions',
                ]),
                'dispositions' => json_encode([
                    '1' => 'Call Back.',
                    '2' => 'Not Interested.',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q4
            [
                'question' => ', Have you heard about ABC?',
                'answers' => json_encode([
                    'yes' => 'YES',
                    'no' => 'NO',
                ]),
                'next_question' => json_encode([
                    'yes' => 5,
                    'no' => 5,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q5
            [
                'question' => 'What\'s your take on these ABC Services?',
                'answers' => json_encode([
                    'excellent' => 'Excellent',
                    'good' => 'Good',
                    'bad' => 'Bad',
                    'poor' => 'Poor',
                ]),
                'next_question' => json_encode([
                    'excellent' => 6,
                    'good' => 6,
                    'bad' => 'Get dispositions',
                    'poor' => 'Get dispositions',
                ]),
                'dispositions' => json_encode([
                    '1' => 'YES',
                    '2' => 'Not Interested.',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q6
            [
                'question' => 'So I believe securing your business information is extremely critical. How do
you back up your business data?  What systems do you currently use?',
                'answers' => json_encode([
                    'drives' => 'Physical drives',
                    'cloud' => 'Cloud',
                    'others' => 'Others',
                ]),
                'next_question' => json_encode([
                    'drives' => 7,
                    'cloud' => 7,
                    'others' => 7,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q7
            [
                'question' => 'With that (Personalize client name), you do agree that your business data is extremely
important for your business & needs back up?',
                'answers' => json_encode([
                    'agree' => 'Agree',
                    'disagree' => 'Disagree',
                ]),
                'next_question' => json_encode([
                    'agree' => 8,
                    'disagree' => 8,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q8
            [
                'question' => 'Ok. And you do agree that ensuring that, it’s backed up automatically in a secure, off site
location gives you a piece of mind that your business info is safe?',
                'answers' => json_encode([
                    'agree' => 'Agree',
                    'disagree' => 'Disagree',
                ]),
                'next_question' => json_encode([
                    'agree' => 9,
                    'disagree' => 9,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q9
            [
                'question' => 'You also agree that that our service is very affordable, right?',
                'answers' => json_encode([
                    'agree' => 'Agree',
                    'disagree' => 'Disagree',
                ]),
                'next_question' => json_encode([
                    'agree' => 10,
                    'disagree' => 10,
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q10
            [
                'question' => 'Fantastic. If you’d so kind as to giving us an appropriate time in the week one of our business
executives will come over to discuss the solution in detail.',
                'answers' => json_encode([
                    'yes' => 'YES',//Capture date and time for the appointment.
                    'no' => 'NO',//Get dispositions
                ]),
                'next_question' => json_encode([
                    'yes' => 11,
                    'no' => 11,
                ]),
                'dispositions' => json_encode([
                    '1' => 'Call Back.',
                    '2' => 'Not Interested.',
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q11
            [
                'question' => 'Kindly assist us with your email address to sent an appointment invite whereby one of our
representatives will visit you and take you through the process of registration / set up and get you ready
for the services.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q12
            [
                'question' => 'Is there any question you would like me to address with regards to our Services / or any
clarification on the information I have given you?',
                'answers' => json_encode([
                    'yes' => 'YES',//Capture Detail
                    'no' => 'NO',//End Call
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q13
            [
                'question' => 'Is this call an escalation?',
                'answers' => json_encode([
                    'yes' => 'YES',//Capture email id & phone number and send auto email and text sms both to this email once completing the call
                    'no' => 'NO',//End Call
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // TODO Q14
            [
                'question' => 'Calling Ending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // store sample questions and answers for the script
        foreach ($scripts as $script) {
            DB::table((new Script())->getTable())->insert($script);
        }
    }
}
