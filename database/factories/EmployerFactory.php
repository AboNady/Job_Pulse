<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployerFactory extends Factory
{
    // Moved logos to a static array to keep the 'definition' clean
    protected static $logos = [
    'https://picsum.photos/seed/27914/100/100',
    'https://picsum.photos/seed/83475/100/100',
    'https://picsum.photos/seed/16290/100/100',
    'https://picsum.photos/seed/45321/100/100',
    'https://picsum.photos/seed/90837/100/100',
    'https://picsum.photos/seed/34756/100/100',
    'https://picsum.photos/seed/76249/100/100',
    'https://picsum.photos/seed/12048/100/100',
    'https://picsum.photos/seed/55403/100/100',
    'https://picsum.photos/seed/99123/100/100',
    'https://picsum.photos/seed/40382/100/100',
    'https://picsum.photos/seed/63450/100/100',
    'https://picsum.photos/seed/21875/100/100',
    'https://picsum.photos/seed/57614/100/100',
    'https://picsum.photos/seed/85037/100/100',
    'https://picsum.photos/seed/19024/100/100',
    'https://picsum.photos/seed/47295/100/100',
    'https://picsum.photos/seed/30982/100/100',
    'https://picsum.photos/seed/68314/100/100',
    'https://picsum.photos/seed/74560/100/100',
    'https://picsum.photos/seed/51237/100/100',
    'https://picsum.photos/seed/26749/100/100',
    'https://picsum.photos/seed/90823/100/100',
    'https://picsum.photos/seed/13405/100/100',
    'https://picsum.photos/seed/39481/100/100',
    'https://picsum.photos/seed/67324/100/100',
    'https://picsum.photos/seed/82137/100/100',
    'https://picsum.photos/seed/45082/100/100',
    'https://picsum.photos/seed/21654/100/100',
    'https://picsum.photos/seed/78910/100/100',
    'https://picsum.photos/seed/50239/100/100',
    'https://picsum.photos/seed/63421/100/100',
    'https://picsum.photos/seed/14798/100/100',
    'https://picsum.photos/seed/50932/100/100',
    'https://picsum.photos/seed/86310/100/100',
    'https://picsum.photos/seed/31024/100/100',
    'https://picsum.photos/seed/67854/100/100',
    'https://picsum.photos/seed/43219/100/100',
    'https://picsum.photos/seed/25678/100/100',
    'https://picsum.photos/seed/78945/100/100',
    'https://picsum.photos/seed/34567/100/100',
    'https://picsum.photos/seed/91234/100/100',
    'https://picsum.photos/seed/45123/100/100',
    'https://picsum.photos/seed/76329/100/100',
    'https://picsum.photos/seed/58710/100/100',
    'https://picsum.photos/seed/24981/100/100',
    'https://picsum.photos/seed/90312/100/100',
    'https://picsum.photos/seed/15678/100/100',
    'https://picsum.photos/seed/67429/100/100',
    'https://picsum.photos/seed/34129/100/100',
    'https://picsum.photos/seed/81567/100/100',
    'https://picsum.photos/seed/29845/100/100',
    'https://picsum.photos/seed/56432/100/100',
    'https://picsum.photos/seed/73210/100/100',
    'https://picsum.photos/seed/49012/100/100',
    'https://picsum.photos/seed/65743/100/100',
    'https://picsum.photos/seed/29401/100/100',
    'https://picsum.photos/seed/81367/100/100',
    'https://picsum.photos/seed/35678/100/100',
    'https://picsum.photos/seed/92834/100/100',
    'https://picsum.photos/seed/47038/100/100',
    'https://picsum.photos/seed/60421/100/100',
    'https://picsum.photos/seed/13952/100/100',
    'https://picsum.photos/seed/71890/100/100',
    'https://picsum.photos/seed/27513/100/100',
    'https://picsum.photos/seed/86412/100/100',
    'https://picsum.photos/seed/34216/100/100',
    'https://picsum.photos/seed/57123/100/100',
    'https://picsum.photos/seed/60987/100/100',
    'https://picsum.photos/seed/43128/100/100',
    'https://picsum.photos/seed/75849/100/100',
    'https://picsum.photos/seed/92035/100/100',
    'https://picsum.photos/seed/67431/100/100',
    'https://picsum.photos/seed/26014/100/100',
    'https://picsum.photos/seed/37589/100/100',
    'https://picsum.photos/seed/84910/100/100',
    'https://picsum.photos/seed/50327/100/100',
    'https://picsum.photos/seed/71045/100/100',
    'https://picsum.photos/seed/89432/100/100',
    'https://picsum.photos/seed/31847/100/100',
    'https://picsum.photos/seed/45098/100/100',
    'https://picsum.photos/seed/62914/100/100',
    'https://picsum.photos/seed/74105/100/100',
    'https://picsum.photos/seed/38246/100/100',
    'https://picsum.photos/seed/90481/100/100',
    ];

    public function definition(): array
    {
        $techNames = [
            'Nebula AI', 'Quantum Soft', 'Pixel Logic', 'Stack Systems', 'CloudScale',
            'DevFlow', 'Infinite Loop', 'Syntax Studio', 'BitWise', 'Echo Labs',
            'CyberNodes', 'GridLock Security', 'Hyperion', 'Matrix Ops', 'Stratos Cloud',
            'DataPeak', 'Quasar Data', 'Aether Networks', 'Binary Forge', 'Lunar Base',
            'Bloom Studio', 'Canvas Digital', 'Spark Creative', 'Mosaic Media', 'Fable Interactive',
        ];

        $techLocations = [
            '101 Silicon Valley Blvd, Palo Alto, CA', '200 Tech Park, Austin, TX',
            '123 Startup Hub, Berlin, Germany', '456 Code Street, London, UK',
            'Remote (Worldwide)', 'Remote (US Only)', 'Remote (EU Only)',
            '321 AI Plaza, Toronto, Canada', '888 Harbour View, Sydney, Australia',
        ];
        // FIX: Remove 'unique()' from randomElement. 
        // Instead, make the name unique by appending a random number at the end.
        $baseName = $this->faker->randomElement($techNames);
        $name = $baseName . ' ' . $this->faker->unique()->numberBetween(100, 9999);

        // Clean slug for email (remove the numbers if you want cleaner emails, or keep them)
        $cleanName = Str::slug($baseName, ''); 
        $tld = $this->faker->randomElement(['io', 'ai', 'tech', 'com', 'co', 'dev']);
        
        // Add random number to email too, to avoid unique constraint errors there
        $email = 'careers@' . $cleanName . $this->faker->numberBetween(1, 999) . '.' . $tld;

        return [
            'user_id' => User::factory(),
            'name'    => $name,   // e.g. "Nebula AI 452"
            'email'   => $email,  // e.g. "careers@nebulaai12.io"
            'phone'   => $this->faker->phoneNumber(),
            'address' => $this->faker->randomElement($techLocations),   
            'logo'    => $this->faker->randomElement(self::$logos)
        ];
    }
}