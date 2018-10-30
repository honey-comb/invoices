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

namespace HoneyComb\Invoices\Services\Admin;

use HoneyComb\Invoices\Repositories\Admin\HCInvoiceSeriesRepository;

/**
 * Class HCInvoiceSeriesService
 * @package HoneyComb\Invoices\Services\Admin
 */
class HCInvoiceSeriesService
{
    /**
     * @var HCInvoiceSeriesRepository
     */
    private $repository;

    /**
     * HCInvoiceSeriesService constructor.
     * @param HCInvoiceSeriesRepository $repository
     */
    public function __construct(HCInvoiceSeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return HCInvoiceSeriesRepository
     */
    public function getRepository(): HCInvoiceSeriesRepository
    {
        return $this->repository;
    }

    /**
     * @param string $code
     * @return string
     */
    public function getInvoiceCode(string $code): string
    {
        $code = strtoupper($code);

        $record = $this->getRepository()->makeQuery()->firstOrCreate(['id' => $code]);

        $record->increment('sequence');

        return sprintf('%s-%s',
            $record->id,
            str_pad(
                $record->sequence,
                is_null($record->padding) ? 5 : $record->padding,
                '0',
                STR_PAD_LEFT
            )
        );
    }
}
