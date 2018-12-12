<?php
/**
 * @copyright 2018 innovationbase
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * Contact InnovationBase:
 * E-mail: hello@innovationbase.eu
 * https://innovationbase.eu
 */

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\HoneyComb\Invoices\Models\HCInvoice::class, function (Faker $faker) {
    $quantity = rand(1, 5);

    $unitPrice = $faker->randomFloat(10, 15);
    $unitDiscount = $faker->randomFloat(1, 3);

    $totalPrice = $quantity * $unitPrice;
    $totalDiscount = $quantity * $unitDiscount;
    $finalPrice = $totalPrice - $totalDiscount;

    return [
        'primary_currency' => 'EUR',
        'seller_raw' => $faker->text,
        'buyer_raw' => $faker->text,

        'total_price' => $totalPrice,
        'total_price_before_tax' => $totalPrice - $totalPrice * 0.21,
        'total_price_tax_amount' => $totalPrice * 0.21,

        'total_discount' => $totalDiscount,
        'total_discount_before_tax' => $totalDiscount - $totalDiscount * 0.21,
        'total_discount_tax_amount' => $totalDiscount * 0.21,

        'final_price' => $finalPrice,
        'final_price_before_tax' => $finalPrice - $finalPrice * 0.21,
        'final_price_tax_amount' => $finalPrice * 0.21,
    ];
});
