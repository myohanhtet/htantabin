<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key' => 'luckydraw-invoice-title-one',
                'value' => 'ရန်ကုန်တိုင်းဒေသကြီး၊ ကမာရွတ်မြို့နယ်၊ ထန်းတပင်ကျောင်းတိုက်'
            ],
            [
                'key' => 'luckydraw-invoice-title-two',
                'value' => 'ကိုးနဝင်းကပ်ကျော်သိမ်ဦးစေတီတော်၊ ([times])ကြိမ်မြောက်၊ ဗုဒ္ဓပူဇနိယပွဲတော်'
            ],
            [
                'key' => 'luckydraw-invoice-title-three',
                'value' => 'စာရေးတံမဲ လောင်းလှူပူဇော်ပွဲ၊ စာရေးတံမဲ လက်ခံဖြတ်ပိုင်း'
            ],
            [
                'key' => 'pathan-invoice-title-one',
                'value' => 'ကမာရွတ်မြို့နယ်၊ ထန်းတပင်ကျောင်းတိုက်၊ ကိုးနဝင်းကပ်ကျော်သိမ်ဦးစေတီတော်'
            ],
            [
                'key' => 'pathan-invoice-title-two',
                'value' => '([times])ကြိမ်မြောက်၊ ဗုဒ္ဓပူဇနိယပွဲတော်၊ မဟာပဋ္ဌာန်းရွတ်ဖတ်ပူဇော်ပွဲ'
            ],
            [
                'key' => 'pathan-invoice-title-three',
                'value' => 'ပဋ္ဌာန်းအလှူတော် လက်ခံဖြတ်ပိုင်း'
            ],
            [
                'key' => 'times',
                'value' => 106
            ],
        ];

        foreach ($settings as $setting){
            Setting::create($setting);
        }
    }
}
