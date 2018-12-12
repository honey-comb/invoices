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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateHcInvoiceTable
 */
class CreateHcInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hc_invoice', function (Blueprint $table) {
            $table->increments('count');
            $table->uuid('id')->unique();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('deleted_at')->nullable();

            $table->date('invoice_date')->nullable();
            $table->date('pay_up_to')->nullable();
            $table->enum('status', ['advanced', 'issued', 'payed', 'recalled', 'canceled']);

            $table->string('series', 10)->nullable();
            $table->string('sequence', 10)->nullable();

            $table->string('primary_currency', 3);

            $table->string('sellerable_id', 36)->nullable();
            $table->string('sellerable_type')->nullable();
            $table->text('seller_raw')->nullable();

            $table->string('buyerable_id', 36)->nullable();
            $table->string('buyerable_type')->nullable();
            $table->text('buyer_raw')->nullable();

            $table->string('payment_method')->nullable();

            $table->float('total_price', 20, 6)->default(0.000000);
            $table->float('total_price_before_tax', 20, 6)->default(0.000000);
            $table->float('total_price_tax_amount', 20, 6)->default(0.000000);

            $table->float('total_discount', 20, 6)->default(0.000000);
            $table->float('total_discount_before_tax', 20, 6)->default(0.000000);
            $table->float('total_discount_tax_amount', 20, 6)->default(0.000000);

            $table->float('final_price', 20, 6)->default(0.000000);
            $table->float('final_price_before_tax', 20, 6)->default(0.000000);
            $table->float('final_price_tax_amount', 20, 6)->default(0.000000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_invoice');
    }
}
