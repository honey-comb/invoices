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

$factory->define(\HoneyComb\Invoices\Models\HCInvoiceItem::class, function (Faker $faker) {
    $currency = 'EUR';
    $quantity = rand(1, 5);
    $unitPrice = $faker->randomFloat(3, 20);
    $amount = $quantity * $unitPrice;
    $vat = $faker->randomFloat(1, 2);
    $vatTotal = $vat * $quantity;
    $discount = $faker->randomFloat(0, 1);
    $discountTotal = $discount * $quantity;
    $amountTotal = $amount + $vat;

    return [
        'invoice_id' => function () use ($amount, $vat, $amountTotal) {
            return factory(\HoneyComb\Invoices\Models\HCInvoice::class)->create([
                'amount' => $amount,
                'vat' => $vat,
                'amount_total' => $amountTotal,
            ])->id;
        },
        'label' => $faker->name,
        'quantity' => $quantity,
        'unit_type' => array_rand(['kg', 'g', 'unit']),
        'unit_price' => $unitPrice,
        'discount' => $discount,
        'amount' => $amount,
        'vat' => $vat,
        'vat_total' => $vatTotal,
        'discount_total' => $discountTotal,
        'amount_total' => $amountTotal,
        'currency' => $currency,
    ];
});
