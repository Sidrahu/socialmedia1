<?php

namespace Database\Seeders;
use App\Models\TechNews;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TechNewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tech_news')->insert([
    [
        'title' => 'Laravel 11 Released!',
        'slug' => 'laravel-11-released',
        'body' => 'Laravel 11 has been officially released, introducing several powerful updates. 
        New features include faster routing, improved job batching, better debugging tools, 
        and native support for lazy collections. This version also drops support for older 
        PHP versions, making Laravel 11 more secure and optimized. Developers are encouraged 
        to upgrade for improved performance and modern tooling.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'title' => 'AI + Filament: Smart Dashboards',
        'slug' => 'ai-filament-dashboards',
        'body' => 'AI integration with Filament is transforming dashboard experiences. 
        With machine learning models built into admin panels, users can now view intelligent 
        predictions, automated analytics summaries, and anomaly detection in real-time. 
        This integration helps teams make data-driven decisions quickly and efficiently. 
        It’s a major step forward in combining Laravel ecosystem with modern AI technologies.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'title' => 'Dev Jobs Rising in Pakistan',
        'slug' => 'dev-jobs-pakistan',
        'body' => 'Pakistan’s software industry is experiencing rapid growth, especially in 
        the domain of web development, mobile apps, and AI-based solutions. With an increasing 
        number of international clients outsourcing to Pakistani talent, platforms like 
        Upwork, Fiverr, and remote job boards have seen a surge in job postings. 
        Laravel, React, Python, and DevOps roles are in high demand, offering both 
        freelance and full-time opportunities to local developers.',
        'created_at' => now(),
        'updated_at' => now(),
    ],
]);

    }
}

