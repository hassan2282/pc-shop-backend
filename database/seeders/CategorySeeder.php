<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{

    public function run(): void
    {
        $computerCategory = Category::factory()->create([
            'name' => 'کامپیوتر',
            'slug' => Str::slug('موبایل و تبلت'),
        ]);

        Category::factory()->create([
            'name' => 'کیس',
            'slug' => Str::slug('کیس'),
            'parent_id' => $computerCategory->id,
        ]);
        Category::factory()->create([
            'name' => 'مینی کیس',
            'slug' => Str::slug('مینی کیس'),
            'parent_id' => $computerCategory->id,
        ]);
        Category::factory()->create([
            'name' => 'گیمینگ',
            'slug' => Str::slug('گیمینگ'),
            'parent_id' => $computerCategory->id,
        ]);
        Category::factory()->create([
            'name' => 'گیمینگ',
            'slug' => Str::slug('گیمینگ'),
            'parent_id' => $computerCategory->id,
        ]);
        Category::factory()->create([
            'name' => 'اداری',
            'slug' => Str::slug('اداری'),
            'parent_id' => $computerCategory->id,
        ]);
        Category::factory()->create([
            'name' => 'مهندسی',
            'slug' => Str::slug('مهندسی'),
            'parent_id' => $computerCategory->id,
        ]);

        // Category: لوازم موبایل و تبلت
        $mobileTabletCategory = Category::factory()->create([
            'name' => 'موبایل و تبلت',
            'slug' => Str::slug('موبایل و تبلت'),
        ]);
        

        $mobileCategory = Category::factory()->create([
            'name' => 'گوشی موبایل',
            'slug' => Str::slug('گوشی موبایل'),
            'parent_id' => $mobileTabletCategory->id,
        ]);

        $tabletCategory = Category::factory()->create([
            'name' => 'تبلت',
            'slug' => Str::slug('تبلت'),
            'parent_id' => $mobileTabletCategory->id,
        ]);

        // Category: لوازم جانبی موبایل
        $mobileAccessoriesCategory = Category::factory()->create([
            'name' => 'لوازم جانبی موبایل',
            'slug' => Str::slug('لوازم جانبی موبایل'),
            'parent_id' => $mobileTabletCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'گلس و محافظ صفحه',
            'slug' => Str::slug('گلس و محافظ صفحه'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'قاب و کاور موبایل',
            'slug' => Str::slug('قاب و کاور موبایل'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'شارژر و کابل',
            'slug' => Str::slug('شارژر و کابل'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'پاوربانک',
            'slug' => Str::slug('پاوربانک'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'هندزفری و هدفون',
            'slug' => Str::slug('هندزفری و هدفون'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'ریستیک و تبدیل',
            'slug' => Str::slug('ریستیک و تبدیل'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'ماگنتی و پایه نگهدارنده',
            'slug' => Str::slug('ماگنتی و پایه نگهدارنده'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'کیف و کوله موبایل',
            'slug' => Str::slug('کیف و کوله موبایل'),
            'parent_id' => $mobileAccessoriesCategory->id,
        ]);

        // Category: لوازم جانبی کامپیوتر
        $computerAccessoriesCategory = Category::factory()->create([
            'name' => 'لوازم جانبی کامپیوتر',
            'slug' => Str::slug('لوازم جانبی کامپیوتر'),
        ]);

        Category::factory()->create([
            'name' => 'کیبورد و ماوس',
            'slug' => Str::slug('کیبورد و ماوس'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'هندزفری و اسپیکر',
            'slug' => Str::slug('هندزفری و اسپیکر'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'هارد اکسترنال و فلش',
            'slug' => Str::slug('هارد اکسترنال و فلش'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);


        Category::factory()->create([
            'name' => 'کارت گرافیک',
            'slug' => Str::slug('کارت گرافیک'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'مانیتور',
            'slug' => Str::slug('مانیتور'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'رم و حافظه SSD',
            'slug' => Str::slug('رم و حافظه SSD'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'کارت صدا و ضبط',
            'slug' => Str::slug('کارت صدا و ضبط'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'پاور و خنک‌کننده',
            'slug' => Str::slug('پاور و خنک‌کننده'),
            'parent_id' => $computerAccessoriesCategory->id,
        ]);

        // Category: لپ‌تاپ
        $laptopCategory = Category::factory()->create([
            'name' => 'لپ‌تاپ',
            'slug' => Str::slug('لپ‌تاپ'),
        ]);

        Category::factory()->create([
            'name' => 'لپ‌تاپ گیمینگ',
            'slug' => Str::slug('لپ‌تاپ گیمینگ'),
            'parent_id' => $laptopCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'لپ‌تاپ اداری',
            'slug' => Str::slug('لپ‌تاپ اداری'),
            'parent_id' => $laptopCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'لپ‌تاپ خلاقانه',
            'slug' => Str::slug('لپ‌تاپ خلاقانه'),
            'parent_id' => $laptopCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'لپ‌تاپ فوق باریک',
            'slug' => Str::slug('لپ‌تاپ فوق باریک'),
            'parent_id' => $laptopCategory->id,
        ]);

        // Category: لوازم جانبی لپ‌تاپ
        $laptopAccessoriesCategory = Category::factory()->create([
            'name' => 'لوازم جانبی لپ‌تاپ',
            'slug' => Str::slug('لوازم جانبی لپ‌تاپ'),
        ]);

        Category::factory()->create([
            'name' => 'پد خنک‌کننده لپ‌تاپ',
            'slug' => Str::slug('پد خنک‌کننده لپ‌تاپ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'محفظه لپ‌تاپ',
            'slug' => Str::slug('محفظه لپ‌تاپ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'موس لپ‌تاپ',
            'slug' => Str::slug('موس لپ‌تاپ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'کیبورد لپ‌تاپ',
            'slug' => Str::slug('کیبورد لپ‌تاپ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'هارد اکسترنال',
            'slug' => Str::slug('هارد اکسترنال'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'تبدیل و هاب USB',
            'slug' => Str::slug('تبدیل و هاب USB'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'ریستیک شارژ لپ‌تاپ',
            'slug' => Str::slug('ریستیک شارژ لپ‌تاپ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([

            'name' => 'صفحه کلید محافظ',
            'slug' => Str::slug('صفحه کلید محافظ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'وب‌کم',
            'slug' => Str::slug('وب‌کم'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'دوربین و میکروفون',
            'slug' => Str::slug('دوربین و میکروفون'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'پایه لپ‌تاپ',
            'slug' => Str::slug('پایه لپ‌تاپ'),
            'parent_id' => $laptopAccessoriesCategory->id,
        ]);

        // Category: سایر دسته‌بندی‌های الکترونیکی
        $otherElectronicsCategory = Category::factory()->create([
            'name' => 'سایر لوازم الکترونیکی',
            'slug' => Str::slug('سایر لوازم الکترونیکی'),
        ]);

        Category::factory()->create([
            'name' => 'دوربین و تجهیزات عکاسی',
            'slug' => Str::slug('دوربین و تجهیزات عکاسی'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'ساعت هوشمند و مچ‌بند',
            'slug' => Str::slug('ساعت هوشمند و مچ‌بند'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'کنسول بازی',
            'slug' => Str::slug('کنسول بازی'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'هدفون و اسپیکر',
            'slug' => Str::slug('هدفون و اسپیکر'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'کنترلر و دسته بازی',
            'slug' => Str::slug('کنترلر و دسته بازی'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'تجهیزات شبکه',
            'slug' => Str::slug('تجهیزات شبکه'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        Category::factory()->create([
            'name' => 'مانیتور و تلویزیون',
            'slug' => Str::slug('مانیتور و تلویزیون'),
            'parent_id' => $otherElectronicsCategory->id,
        ]);

        // Create 10 additional factory categories for future use
        // Category::factory()->count(10)->create();
    }
};