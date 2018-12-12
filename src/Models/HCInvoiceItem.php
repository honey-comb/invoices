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

declare(strict_types = 1);

namespace HoneyComb\Invoices\Models;

use HoneyComb\Starter\Models\HCUuidModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class HCInvoiceItem
 * @package HoneyComb\Invoices\Models
 */
class HCInvoiceItem extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_invoice_item';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'invoice_id',
        'label',
        'quantity',
        'type',
        'unit_type',
        'currency',
        'tax_name',
        'tax_value',
        'unit_price',
        'unit_price_before_tax',
        'unit_price_tax_amount',
        'unit_discount',
        'unit_discount_before_tax',
        'unit_discount_tax_amount',
        'total_price',
        'total_price_before_tax',
        'total_price_tax_amount',
        'total_discount',
        'total_discount_before_tax',
        'total_discount_tax_amount',
        'final_price',
        'final_price_before_tax',
        'final_price_tax_amount',
    ];

    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(HCInvoice::class, 'id', 'invoice_id');
    }
}
