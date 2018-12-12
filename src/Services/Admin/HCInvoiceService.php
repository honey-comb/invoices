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

use HoneyComb\Invoices\Enum\HCInvoiceStatusEnum;
use HoneyComb\Invoices\Exceptions\HCInvoiceException;
use HoneyComb\Invoices\Http\Controllers\Admin\InvoiceException;
use HoneyComb\Invoices\Models\HCInvoice;
use HoneyComb\Invoices\Repositories\Admin\HCInvoiceRepository;

/**
 * Class HCInvoiceService
 * @package HoneyComb\Invoices\Services\Admin
 */
class HCInvoiceService
{
    /**
     * @var HCInvoiceRepository
     */
    private $repository;

    /**
     * @var HCInvoiceSeriesService
     */
    private $invoiceSeriesService;

    /**
     * HCInvoiceService constructor.
     * @param HCInvoiceRepository $repository
     * @param HCInvoiceSeriesService $invoiceSeriesService
     */
    public function __construct(HCInvoiceRepository $repository, HCInvoiceSeriesService $invoiceSeriesService)
    {
        $this->repository = $repository;
        $this->invoiceSeriesService = $invoiceSeriesService;
    }

    /**
     * @return HCInvoiceRepository
     */
    public function getRepository(): HCInvoiceRepository
    {
        return $this->repository;
    }

    /**
     * @param array $invoiceData
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function createAdvanceInvoice(array $invoiceData): HCInvoice
    {
        $this->validateInvoiceData($invoiceData);

        $invoiceData['status'] = HCInvoiceStatusEnum::advanced()->id();
        $invoiceData['series'] = null;
        $invoiceData['sequence'] = null;

        $invoice = $this->getRepository()->create($invoiceData);

        foreach ($invoiceData['items'] as $invoiceItem) {
            $invoice->items()->create($invoiceItem);
        }

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);
    }

    /**
     * @param string $series
     * @param array $invoiceData
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function createIssueInvoice(string $series, array $invoiceData): HCInvoice
    {
        $this->validateInvoiceData($invoiceData);

        $invoiceData['status'] = HCInvoiceStatusEnum::issued()->id();

        // add invoice code
        $invoiceData = array_merge(
            $invoiceData,
            $this->invoiceSeriesService->getInvoiceCodeAsArray($series)
        );

        $invoice = $this->getRepository()->create($invoiceData);

        foreach ($invoiceData['items'] as $invoiceItem) {
            $invoice->items()->create($invoiceItem);
        }

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);
    }

    /**
     * @param string $series
     * @param array $invoiceData
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function createPayedInvoice(string $series, array $invoiceData): HCInvoice
    {
        $this->validateInvoiceData($invoiceData);

        $invoiceData['status'] = HCInvoiceStatusEnum::payed()->id();

        // add invoice code
        $invoiceData = array_merge(
            $invoiceData,
            $this->invoiceSeriesService->getInvoiceCodeAsArray($series)
        );

        $invoice = $this->getRepository()->create($invoiceData);

        foreach ($invoiceData['items'] as $invoiceItem) {
            $invoice->items()->create($invoiceItem);
        }

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);
    }

    /**
     * @param string $invoiceId
     * @param string $status
     * @param null $series
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function changeInvoiceStatus(string $invoiceId, string $status, $series = null): void
    {
        switch ($status) {
            case HCInvoiceStatusEnum::issued()->id():
                $this->changeStatusToIssued($invoiceId, $series);
                break;

            case HCInvoiceStatusEnum::payed()->id():
                $this->changeStatusToPayed($invoiceId, $series);
                break;

            case HCInvoiceStatusEnum::canceled()->id():
                $this->changeStatusToCanceled($invoiceId);
                break;

            case HCInvoiceStatusEnum::recalled()->id():
                $this->changeStatusToRecalled($invoiceId);

                break;
            default:
                throw new HCInvoiceException('Incorrect status');
        }
    }

    /**
     * @param array $invoiceData
     * @throws HCInvoiceException
     */
    protected function validateInvoiceData(array $invoiceData): void
    {
        if (!array_has($invoiceData, [
            'primary_currency',
            'buyer_raw',
            'final_price',
            'final_price_before_tax',
            'final_price_tax_amount',
            'items',
        ])) {
            throw new HCInvoiceException('Invoice data missing required fields');
        }

        if (empty($invoiceData['items'])) {
            throw new HCInvoiceException('Invoice item data missing required fields');
        }

        foreach ($invoiceData['items'] as $invoiceItemData) {
            if (!array_has($invoiceItemData, [
                'label',
                'quantity',
                'unit_type',
                'unit_price',
                'total_price',
                'final_price',
                'final_price_before_tax',
                'final_price_tax_amount',
            ])) {
                throw new HCInvoiceException('Invoice item data missing required fields');
            }
        }
    }

    /**
     * @param string $invoiceId
     * @param string|null $series
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function changeStatusToIssued(string $invoiceId, string $series = null): HCInvoice
    {
        if (is_null($series)) {
            throw new HCInvoiceException('Series parameter is required!');
        }

        $invoice = $this->getRepository()->findOrFail($invoiceId);

        if ($invoice->status != HCInvoiceStatusEnum::advanced()->id()) {
            // TODO add to translations
            throw new HCInvoiceException('To change invoice id status to issued invoice status must be advanced');
        }

        $seriesInfo = $this->invoiceSeriesService->getInvoiceCodeAsArray($series);

        $invoice->series = $seriesInfo['series'];
        $invoice->sequence = $seriesInfo['sequence'];
        $invoice->status = HCInvoiceStatusEnum::issued()->id();
        $invoice->save();

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);
    }

    /**
     * @param string $invoiceId
     * @param string|null $series
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function changeStatusToPayed(string $invoiceId, string $series = null): HCInvoice
    {
        if (is_null($series)) {
            throw new HCInvoiceException('Series parameter is required!');
        }

        $invoice = $this->getRepository()->findOrFail($invoiceId);

        if (in_array($invoice->status, [
            HCInvoiceStatusEnum::canceled()->id(),
            HCInvoiceStatusEnum::recalled()->id(),
        ])) {
            // TODO add to translations
            throw new HCInvoiceException('Invoice is canceled!');
        }

        // change to issued
        if ($invoice->status == HCInvoiceStatusEnum::advanced()->id()) {
            $invoice = $this->changeStatusToIssued($invoiceId, $series);
        }

        // change to payed
        $invoice->status = HCInvoiceStatusEnum::payed()->id();
        $invoice->save();

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);

    }

    /**
     * @param string $invoiceId
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function changeStatusToCanceled(string $invoiceId): HCInvoice
    {
        $invoice = $this->getRepository()->findOrFail($invoiceId);

        if ($invoice->status != HCInvoiceStatusEnum::issued()->id()) {
            // TODO add to translations
            throw new HCInvoiceException('To change status to canceled invoice status must be issued!');
        }

        // change to canceled
        $invoice->status = HCInvoiceStatusEnum::canceled()->id();
        $invoice->save();

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);
    }

    /**
     * @param string $invoiceId
     * @return HCInvoice
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function changeStatusToRecalled(string $invoiceId): HCInvoice
    {
        $invoice = $this->getRepository()->findOrFail($invoiceId);

        if ($invoice->status != HCInvoiceStatusEnum::advanced()->id()) {
            // TODO add to translations
            throw new HCInvoiceException('To change status to recalled invoice status must be advanced!');
        }

        // change to canceled
        $invoice->status = HCInvoiceStatusEnum::recalled()->id();
        $invoice->save();

        // log to history
        $invoice->statusHistory()->create([
            'status' => $invoice->status,
        ]);

        // TODO add events
        return $this->getRepository()->findOrFail($invoice->id);
    }
}
