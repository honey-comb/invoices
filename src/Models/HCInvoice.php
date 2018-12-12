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

use HoneyComb\Starter\Models\HCUuidSoftModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class HCInvoice
 * @package HoneyComb\Invoices\Models
 */
class HCInvoice extends HCUuidSoftModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_invoice';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'invoice_date',
        'pay_up_to',
        'status',
        'series',
        'sequence',
        'primary_currency',
        'sellerable_id',
        'sellerable_type',
        'seller_raw',
        'buyerable_id',
        'buyerable_type',
        'buyer_raw',
        'payment_method',
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
     * @var array
     */
    protected $casts = [
        'seller_raw' => 'array',
        'buyer_raw' => 'array',
    ];

    /**
     * @return HasMany
     */
    public function statusHistory(): HasMany
    {
        return $this->hasMany(HCInvoiceStatusHistory::class, 'invoice_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(HCInvoiceItem::class, 'invoice_id', 'id');
    }
}
