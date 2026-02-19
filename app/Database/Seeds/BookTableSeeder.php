<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BookTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'uid'          => 'f47ac10b-58cc-4372-a567-0e02b2c3d470',
                'category_id'  => 1,
                'title'        => 'Sword Art Online Vol. 1: Aincrad',
                'author'       => 'Reki Kawahara',
                'publisher'    => 'ASCII Media Works',
                'release_date' => '2012-04-10',
                'sipnosis'     => 'In the year 2022, gamers rejoice as Sword Art Online launches. But when tens of thousands log in, they discover they cannot log out. The only way to escape is to beat all 100 floors of the deadly game.',
                'img_url'      => 'https://example.com/sao.jpg',
                'price'        => 120000,
            ],
            [
                'uid'          => 'f47ac10b-58cc-4372-a567-0e02b2c3d471',
                'category_id'  => 2,
                'title'        => 'The Very Hungry Caterpillar',
                'author'       => 'Eric Carle',
                'publisher'    => 'World Publishing Company',
                'release_date' => '1969-06-03',
                'sipnosis'     => 'A small caterpillar eats his way through various foods before transforming into a beautiful butterfly. A classic picture book loved by children worldwide.',
                'img_url'      => 'https://example.com/caterpillar.jpg',
                'price'        => 85000,
            ],
            [
                'uid'          => 'f47ac10b-58cc-4372-a567-0e02b2c3d472',
                'category_id'  => 3,
                'title'        => 'One Piece Vol. 1',
                'author'       => 'Eiichiro Oda',
                'publisher'    => 'Shueisha',
                'release_date' => '1997-12-24',
                'sipnosis'     => 'Monkey D. Luffy sets sail to find the legendary treasure One Piece and become King of the Pirates. His adventure begins with forming his first crew.',
                'img_url'      => 'https://example.com/onepiece.jpg',
                'price'        => 95000,
            ],
            [
                'uid'          => 'f47ac10b-58cc-4372-a567-0e02b2c3d473',
                'category_id'  => 4,
                'title'        => 'Sapiens: A Brief History of Humankind',
                'author'       => 'Yuval Noah Harari',
                'publisher'    => 'Harvill Secker',
                'release_date' => '2011-01-01',
                'sipnosis'     => 'An exploration of how Homo sapiens came to dominate the world, examining biology, history, and the future of our species.',
                'img_url'      => 'https://example.com/sapiens.jpg',
                'price'        => 180000,
            ],
            [
                'uid'          => 'f47ac10b-58cc-4372-a567-0e02b2c3d474',
                'category_id'  => 5,
                'title'        => 'The Hunger Games',
                'author'       => 'Suzanne Collins',
                'publisher'    => 'Scholastic Press',
                'release_date' => '2008-09-14',
                'sipnosis'     => 'In a dystopian future, Katniss Everdeen volunteers to take her sisters place in a deadly televised competition where teenagers fight to the death.',
                'img_url'      => 'https://example.com/hungergames.jpg',
                'price'        => 110000,
            ],
        ];

        $this->db->table('book')->insertBatch($data);
    }
}
