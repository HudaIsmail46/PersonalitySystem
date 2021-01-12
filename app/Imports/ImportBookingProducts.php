<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use App\BookingProduct;
use App\BookingProductCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ImportBookingProducts implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $product_id = @$row[1];
        $bookingProduct = BookingProduct::firstWhere('product_id', '=', $product_id);
        if ($bookingProduct != null) {

            $bookingProduct->fill([
                'product_id' => @$row[1],
                'product_name' => @$row[2],
                'product_code' => is_null(@$row[3]) ? null : @$row[3],
                'category' => @$row[4],
                'description' => strip_tags(@$row[5]),
                'purchase_cost' => $this->convertPrice(@$row[6]),
                'sell_price' => $this->convertPrice(@$row[7]),
                'job_duration_estimation' => @$row[8],

            ]);
            $bookingProduct->save();

            BookingProductCategory::firstOrCreate(['name' => $this->cleanName(@$row[4]), 'weightage' => 1]);
            
        } else {

            return $this->store($row);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function store($row)
    {
        $bookingProduct = new BookingProduct;
        $bookingProduct->fill([
            'product_id' => @$row[1],
            'product_name' => @$row[2],
            'product_code' => is_null(@$row[3]) ? null : @$row[3],
            'category' => @$row[4],
            'description' =>  @$row[5],
            'purchase_cost' => $this->convertPrice(@$row[6]),
            'sell_price' => $this->convertPrice(@$row[7]),
            'job_duration_estimation' => @$row[8],
        ]);
        $bookingProduct->save();

        BookingProductCategory::firstOrCreate(['name' => $this->cleanName(@$row[4]), 'weightage' => 1]);
    }

    public function convertPrice($price)
    {
        $priceCents = str_replace('RM', "", $price);
        $priceValue = (int)((string)($priceCents));
        return priceCents($priceValue);
    }

    public function cleanName($row)
    {
        $categories = rtrim($row , " ");
        return $categories;
    }
}
