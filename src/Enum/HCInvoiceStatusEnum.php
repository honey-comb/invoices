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

namespace HoneyComb\Invoices\Enum;

use HoneyComb\Starter\Enum\Enumerable;

/**
 * Class HCInvoiceStatusEnum
 * @package HoneyComb\Invoices\Enum
 */
class HCInvoiceStatusEnum extends Enumerable
{
    /**
     * @return HCInvoiceStatusEnum
     * @throws \ReflectionException
     */
    final public static function advanced(): HCInvoiceStatusEnum
    {
        return self::make('advanced', trans('HCInvoices::invoices.enum.advanced'), 'just created invoice');
    }

    /**
     * @return HCInvoiceStatusEnum
     * @throws \ReflectionException
     */
    final public static function issued(): HCInvoiceStatusEnum
    {
        return self::make('issued', trans('HCInvoices::invoices.enum.issued'), 'active invoice');
    }

    /**
     * @return HCInvoiceStatusEnum
     * @throws \ReflectionException
     */
    final public static function payed(): HCInvoiceStatusEnum
    {
        return self::make('payed', trans('HCInvoices::invoices.enum.payed'), 'payed invoice');
    }

    /**
     * @return HCInvoiceStatusEnum
     * @throws \ReflectionException
     */
    final public static function recalled(): HCInvoiceStatusEnum
    {
        return self::make('recalled', trans('HCInvoices::invoices.enum.recalled'), 'canceled advanced invoice');
    }

    /**
     * @return HCInvoiceStatusEnum
     * @throws \ReflectionException
     */
    final public static function canceled(): HCInvoiceStatusEnum
    {
        return self::make('canceled', trans('HCInvoices::invoices.enum.canceled'), 'canceled issued invoice');
    }
}
