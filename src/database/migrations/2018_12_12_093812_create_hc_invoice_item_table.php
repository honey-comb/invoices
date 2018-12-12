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
 * Class CreateHcInvoiceItemTable
 */
class CreateHcInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('hc_invoice_item', function (Blueprint $table) {
            $table->increments('count');
            $table->uuid('id')->unique();
            $table->datetime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->datetime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->uuid('invoice_id');
            $table->string('label', 1000);
            $table->float('quantity', 8, 4);
            $table->string('type', 50)->nullable()->index();
            $table->string('unit_type', 20)->nullable();
            $table->string('currency', 3);

            $table->string('tax_name', 100)->nullable();
            $table->smallInteger('tax_value')->default(0);

            $table->float('unit_price', 20, 6)->default(0)->index();
            $table->float('unit_price_before_tax', 20, 6)->default(0);
            $table->float('unit_price_tax_amount', 20, 6)->default(0);

            $table->float('unit_discount', 20, 6)->default(0);
            $table->float('unit_discount_before_tax', 20, 6)->default(0);
            $table->float('unit_discount_tax_amount', 20, 6)->default(0);

            $table->float('total_price', 20, 6)->default(0);
            $table->float('total_price_before_tax', 20, 6)->default(0);
            $table->float('total_price_tax_amount', 20, 6)->default(0);

            $table->float('total_discount', 20, 6)->default(0);
            $table->float('total_discount_before_tax', 20, 6)->default(0);
            $table->float('total_discount_tax_amount', 20, 6)->default(0);

            $table->float('final_price', 20, 6)->default(0);
            $table->float('final_price_before_tax', 20, 6)->default(0);
            $table->float('final_price_tax_amount', 20, 6)->default(0);

            $table->foreign('invoice_id')->references('id')->on('hc_invoice')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('hc_invoice_item');
    }
}
