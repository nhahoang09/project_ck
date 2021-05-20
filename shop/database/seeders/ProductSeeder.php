<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Thumbnail;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = Category::pluck('id')->toArray();


        $listProductNames = [
            'Bánh Crepe Sầu riêng',
            'Bánh Crepe Chocolate',
            'Bánh Crepe Sầu riêng',
            'Bánh Crepe Đào',
            'Bánh Crepe Dâu',
            'Bánh Crepe Pháp',
            'Bánh Crepe Táo',
            'Bánh Crepe Trà xanh',
            'Bánh Crepe Sầu riêng và Dứa',
            'Bánh Gato Trái cây Việt Quất',
            'Bánh sinh nhật rau câu trái cây',
            'Bánh kem Chocolate Dâu',
            'Bánh kem Dâu III',
            'Bánh kem Dâu I',
            'Bánh trái cây II',
            'Apple Cake', 3,
            'Bánh ngọt nhân cream táo',
            'Bánh Chocolate Trái cây',
            'Bánh Chocolate Trái cây II',
            'Peach Cake',
            'Bánh bông lan trứng muối I',
            'Bánh bông lan trứng muối II',
            'Bánh French',
            'Bánh mì Australia',
            'Bánh mặn thập cẩm',
            'Bánh Muffins trứng',
            'Bánh Scone Peach Cake',
            'Bánh mì Việt Nam I',
            'Bánh kem Chocolate Dâu I',
            'Bánh kem Trái cây I',
            'Bánh kem Trái cây II',
            'Bánh kem Doraemon',
            'Bánh kem Caramen Pudding',
            'Bánh kem Chocolate Fruit',
            'Bánh kem Coffee Chocolate',
            'Bánh kem Mango Mouse',
            'Bánh kem Matcha Mouse',
            'Bánh kem Flower Fruit',
            'Bánh kem Strawberry Delight',
            'Bánh kem Raspberry Delight',
            'Beefy Pizza',
            'Hawaii Pizza',
            'Smoke Chicken Pizza',
            'Sausage Pizza',
            'Ocean Pizza',
            'All Meaty Pizza',
            'Tuna Pizza',
            'Bánh su kem nhân dừa',
            'Bánh su kem sữa tươi',
            'Bánh su kem sữa tươi chiên giòn',
            'Bánh su kem dâu sữa tươi',
            'Bánh su kem bơ sữa tươi',
            'Bánh su kem nhân trái cây sữa tươi',
            'Bánh su kem cà phê',
            'Bánh su kem phô mai',
            'Bánh su kem sữa tươi chocolate',
            'Bánh Macaron Pháp',
            'Bánh Tiramisu - Italia',
            'Bánh Táo - Mỹ',
            'Bánh Cupcake - Anh Quốc',
            'Bánh Sachertorte',
        ];

        $listProductDescriptions = [
            'Nếu từng bị mê hoặc bởi các loại tarlet ngọt thì chắn chắn bạn không thể bỏ qua những loại tarlet mặn. Ngoài hình dáng bắt mắt, lớp vở bánh giòn giòn cùng với nhân mặn như thịt gà, nấm, thị heo ,… của bánh sẽ chinh phục bất cứ ai dùng thử.',
            'Bánh ngọt là một loại thức ăn thường dưới hình thức món bánh dạng bánh mì từ bột nhào, được nướng lên dùng để tráng miệng. Bánh ngọt có nhiều loại, có thể phân loại dựa theo nguyên liệu và kỹ thuật chế biến như bánh ngọt làm từ lúa mì, bơ, bánh ngọt dạng bọt biển. Bánh ngọt có thể phục vụ những mục đính đặc biệt như bánh cưới, bánh sinh nhật, bánh Giáng sinh, bánh Halloween..',
            'Bánh trái cây', 'Bánh trái cây, hay còn gọi là bánh hoa quả, là một món ăn chơi, không riêng gì của Huế nhưng khi "lạc" vào mảnh đất Cố đô, món bánh này dường như cũng mang chút tinh tế, cầu kỳ và đặc biệt. Lấy cảm hứng từ những loại trái cây trong vườn, qua bàn tay khéo léo của người phụ nữ Huế, món bánh trái cây ra đời - ngọt thơm, dịu nhẹ làm đẹp lòng biết bao người thưởng thức.',
            'Với người Việt Nam thì bánh ngọt nói chung đều hay được quy về bánh bông lan – một loại tráng miệng bông xốp, ăn không hoặc được phủ kem lên thành bánh kem. Tuy nhiên, cốt bánh kem thực ra có rất nhiều loại với hương vị, kết cấu và phương thức làm khác nhau chứ không chỉ đơn giản là “bánh bông lan” chung chung đâu nhé!',
            'Crepe là một món bánh nổi tiếng của Pháp, nhưng từ khi du nhập vào Việt Nam món bánh đẹp mắt, ngon miệng này đã làm cho biết bao bạn trẻ phải “xiêu lòng”',
            'Pizza đã không chỉ còn là một món ăn được ưa chuộng khắp thế giới mà còn được những nhà cầm quyền EU chứng nhận là một phần di sản văn hóa ẩm thực châu Âu. Và để được chứng nhận là một nhà sản xuất pizza không hề đơn giản. Người ta phải qua đủ mọi các bước xét duyệt của chính phủ Ý và liên minh châu Âu nữa… tất cả là để đảm bảo danh tiếng cho món ăn này.',
            'Bánh su kem là món bánh ngọt ở dạng kem được làm từ các nguyên liệu như bột mì, trứng, sữa, bơ.... đánh đều tạo thành một hỗn hợp và sau đó bằng thao tác ép và phun qua một cái túi để định hình thành những bánh nhỏ và cuối cùng được nướng chín. Bánh su kem có thể thêm thành phần Sô cô la để tăng vị hấp dẫn. Bánh có xuất xứ từ nước Pháp.',

        ];

        $quantities = [20, 40, 60, 80, 100, 200];

        $listThumbnails = [
            '54eaf93713081_-_07-germany-tuna.jpg',
            '111.jpg',
            '234.jpg',
            '544bc48782741.png',
            '1234.jpg',
            '40819_food_pizza.jpg',
            '210215-banh-sinh-nhat-rau-cau-body- (6).jpg',
            '50020041-combo-20-banh-su-que-pho-mai-9.jpg',
            '1430967449-pancake-sau-rieng-6.jpg',
            '1434429117-banh-su-kem-chien-20.jpg',


        ];

        for ($i = 0; $i <30 ; $i++) {
            $product = [
                'name' => $listProductNames[array_rand($listProductNames)],
                'description' => $listProductDescriptions[array_rand($listProductDescriptions)],
                'thumbnail' => $listThumbnails[array_rand($listThumbnails)],
                'status' => 1,
                'quantity' => $quantities[array_rand($quantities)],
                'is_feature' => 0,
                'category_id' => $categories[array_rand($categories)],
            ];
            $saveProduct = Product::create($product);

            // product_detali
                $productDetail = [
                    'content' => $listProductDescriptions[array_rand($listProductDescriptions)],
                    'product_id' => $saveProduct->id,
                ];
                ProductDetail::create($productDetail);

            // save product_images

                $productImage = [
                    'url' => $listThumbnails[array_rand($listThumbnails)],
                    'product_id' => $saveProduct->id,
                ];
                Thumbnail::create($productImage);


        }
    }
}
