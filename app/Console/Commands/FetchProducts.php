<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Throwable;

class FetchProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch products and store unique records.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $retrievePagesAmount = 3;
        $limit = 10;
        $skip = 0;

        try {
            for ($page = 1; $page <= $retrievePagesAmount; $page++) {
                $response = Http::withoutVerifying()
                    ->get("https://dummyjson.com/products?limit=$limit&skip=$skip");

                if ($response->successful()) {
                    $this->storeProducts($response['products']);
                    $skip += $limit;
                } else {
                    Log::error("Failed to retrieve products from page $page");
                }
            }
        } catch (Throwable $e) {
            Log::error(
                "An error occurred while fetching products.",
                [
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * Store unique products into db from current batch of records
     *
     * @param array $products
     *
     * @return void
     */
    protected function storeProducts(array $products)
    {
        foreach ($products as $product) {
            Product::updateOrCreate(
                [
                    'external_id' => $product['id'],
                ],
                [
                    'title' => $product['title'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'discount_percentage' => $product['discountPercentage'],
                    'rating' => $product['rating'],
                    'stock' => $product['stock'],
                    'brand' => $product['brand'],
                    'category' => $product['category'],
                    'thumbnail' => $product['thumbnail'],
                    'images' => json_encode($product['images']),
                ]
            );
        }
    }
}
