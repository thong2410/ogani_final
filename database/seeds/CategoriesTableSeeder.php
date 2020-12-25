<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'cate_id' => 1,
                'name' => 'Rau - củ - quả',
                'description' => 'Rau củ quả sạch, an toàn không chất bảo quản',
                'parent_id' => null
            ]
            ,[
                'cate_id' => 2,
                'name' => 'Sữa các loại',
                'description' => 'Các loại sữa',
                'parent_id' => null
            ]
            ,[
                'cate_id' => 3,
                'name' => 'Sữa tươi',
                'description' => '',
                'parent_id' => 2
            ]
            ,[
                'cate_id' => 4,
                'name' => 'Sữa đặc',
                'description' => '',
                'parent_id' => 2
            ]
            ,[
                'cate_id' => 5,
                'name' => 'Sữa chua, phô mai',
                'description' => '',
                'parent_id' => 2
            ]
            ,[
                'cate_id' => 6,
                'name' => 'Sữa ca cao, lúa mạch',
                'description' => '',
                'parent_id' => 2
            ]
            ,[
                'cate_id' => 7,
                'name' => 'Yến mạch, ngũ cốc',
                'description' => '',
                'parent_id' => 2
            ]
            ,[
                'cate_id' => 8,
                'name' => 'Sữa bột',
                'description' => '',
                'parent_id' => 2
            ]
            ,[
                'cate_id' => 9,
                'name' => 'Thực phẩm khô',
                'description' => '',
                'parent_id' => null
            ]
            ,[
                'cate_id' => 10,
                'name' => 'Gạo',
                'description' => '',
                'parent_id' => 9
            ]
            ,[
                'cate_id' => 11,
                'name' => 'Đồ hộp',
                'description' => '',
                'parent_id' => 9
            ]
            ,[
                'cate_id' => 12,
                'name' => 'Ngũ cốc, yến mạch',
                'description' => '',
                'parent_id' => 9
            ]
            ,[
                'cate_id' => 13,
                'name' => 'Bột',
                'description' => '',
                'parent_id' => 9
            ]
            ,[
                'cate_id' => 14,
                'name' => 'Đồ đông lạnh',
                'description' => '',
                'parent_id' => null
            ]
            ,[
                'cate_id' => 15,
                'name' => 'Thịt',
                'description' => '',
                'parent_id' => 14
            ]
            ,[
                'cate_id' => 16,
                'name' => 'Hải sản',
                'description' => 'Hải sản tươi sống giá rẻ',
                'parent_id' => 14
            ]
            ,[
                'cate_id' => 17,
                'name' => 'Rau củ',
                'description' => '',
                'parent_id' => 14
            ]
            ,[
                'cate_id' => 18,
                'name' => 'Thực phẩm chế biến sẵn',
                'description' => '',
                'parent_id' => 14
            ]
            ,[
                'cate_id' => 19,
                'name' => 'Đồ uống',
                'description' => 'Đồ uống, nước giải khát, nước tăng lực....',
                'parent_id' => null
            ]
            ,[
                'cate_id' => 20,
                'name' => 'Nước ngọt',
                'description' => '',
                'parent_id' => 19
            ]
            ,[
                'cate_id' => 21,
                'name' => 'Cà phê',
                'description' => '',
                'parent_id' => 19
            ]
            ,[
                'cate_id' => 22,
                'name' => 'Nước trái cây',
                'description' => '',
                'parent_id' => 19
            ]
            ,[
                'cate_id' => 23,
                'name' => 'Mật ong, tinh bột nghệ',
                'description' => '',
                'parent_id' => 19
            ]

            ];

        foreach($categories as $cat){
            DB::table('categories')->insert($cat);
        }
    
    }
}
