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
        'amount',
        'vat',
        'amount_total',
        'payment_method',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'seller',
        'buyer',
    ];

    /**
     * @return array
     */
    public function getBuyerAttribute(): array
    {
        if (filled($this->buyer_raw)) {
            return json_decode($this->buyer_raw, true);
        }

        return [];
    }

    /**
     * @return array
     */
    public function getSellerAttribute(): array
    {
        if (filled($this->seller_raw)) {
            return json_decode($this->seller_raw, true);
        }

        return [];
    }

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
