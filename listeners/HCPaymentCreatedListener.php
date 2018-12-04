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

namespace App\Listeners;

use HoneyComb\Invoices\DTO\HCInvoiceDTO;
use HoneyComb\Invoices\DTO\HCInvoiceItemDTO;
use HoneyComb\Invoices\Exceptions\HCInvoiceException;
use HoneyComb\Invoices\Services\Admin\HCInvoiceService;
use HoneyComb\Payments\Events\HCPaymentCreated;
use HoneyComb\Payments\Models\HCPayment;

/**
 * Class HCPaymentCreatedListener
 * @package App\Listeners
 */
class HCPaymentCreatedListener
{
    /**
     * @var HCInvoiceService
     */
    private $invoiceService;

    /**
     * @param HCInvoiceService $invoiceService
     */
    public function __construct(HCInvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    /**
     * Handle the event.
     *
     * @param HCPaymentCreated $event
     * @return void
     * @throws HCInvoiceException
     * @throws \ReflectionException
     */
    public function handle(HCPaymentCreated $event)
    {
        $payment = $event->payment;

        $order = $this->getOrder($payment);

        $invoice = $this->invoiceService->createAdvanceInvoice(
            $this->getInvoiceData($payment, $order)
        );

        // save invoice id
        $payment->invoice_id = $invoice->id;
        $payment->save();

        // Send Notifications / Emails
    }

    /**
     * @param HCPayment $payment
     * @return array
     */
    protected function getOrder(HCPayment $payment): array
    {
        // TODO change to your project architecture
        if ($orderTable = true) {
            // get order with items
            // $order =  $this->orderRepository->findByOrderNumber($payment->order_number)->toArray();
            return [];
        }

        // use payment orders
        return $payment->order;
    }

    /**
     * @param HCPayment $payment
     * @param array $order
     * @return array
     */
    protected function getInvoiceData(HCPayment $payment, array $order): array
    {
        $items = [];

        // TODO set items by your order structure
        foreach ($order['items'] as $item) {
            $items[] = (new HCInvoiceItemDTO())
                ->setLabel($item['label'])
                ->setQuantity($item['quantity'])
                ->setAmount($item['amount'])
                ->setVat($item['vat_amount'])
                ->setUnitPrice($item['unit_price'])
                ->setVatTotal($item['vat_total'])
                ->setAmountTotal($item['amount_total']);
        }

        $invoiceDto = (new HCInvoiceDTO())
            ->setAmount($order['amount'])
            ->setAmountTotal($order['amount_total'])
            ->setVat($order['vat'])
            ->setInvoiceDate(now())
            ->setBuyerableId($payment->ownerable_id)
            ->setBuyerableType($payment->ownerable_type)
            ->setItems($items);

        return $invoiceDto->toArray();
    }
}
