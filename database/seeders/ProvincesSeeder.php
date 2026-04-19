<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = [
            "آذربایجان شرقی",
            "آذربایجان غربی",
            "اردبیل",
            "اصفهان",
            "البرز",
            "ایلام",
            "بوشهر",
            "تهران",
            "چهارمحال و بختیاری",
            "خراسان جنوبی",
            "خراسان رضوی",
            "خراسان شمالی",
            "خوزستان",
            "زنجان",
            "سمنان",
            "سیستان و بلوچستان",
            "فارس",
            "قزوین",
            "قم",
            "کردستان",
            "کرمان",
            "کرمانشاه",
            "کهگیلویه و بویراحمد",
            "گلستان",
            "گیلان",
            "لرستان",
            "مازندران",
            "مرکزی",
            "هرمزگان",
            "همدان",
            "یزد"
        ];


        foreach($provinces as $province){
            Province::create(['name' => $province]);
        }

    }
}
