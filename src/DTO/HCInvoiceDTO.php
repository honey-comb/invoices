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

namespace HoneyComb\Invoices\DTO;

use HoneyComb\Starter\DTO\HCBaseDTO;

/**
 * Class HCInvoiceDTO
 * @package HoneyComb\Invoices\DTO
 */
class HCInvoiceDTO extends HCBaseDTO
{
    /**
     * @var string
     */
    private $invoiceDate;

    /**
     * @var string
     */
    private $payUpTo;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $series;

    /**
     * @var string
     */
    private $sequence;

    /**
     * @var string
     */
    private $primaryCurrency;

    /**
     * @var string
     */
    private $sellerableId;

    /**
     * @var string
     */
    private $sellerableType;

    /**
     * @var string
     */
    private $sellerRaw;

    /**
     * @var string
     */
    private $buyerableId;

    /**
     * @var string
     */
    private $buyerableType;

    /**
     * @var string
     */
    private $buyerRaw;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $vat;

    /**
     * @var float
     */
    private $amountTotal;

    /**
     * @var string
     */
    private $paymentMethod;

    /**
     * @var array
     */
    private $items;

    /**
     * @return string|null
     */
    public function getInvoiceDate(): ?string
    {
        return $this->invoiceDate;
    }

    /**
     * @param string $invoiceDate
     * @return HCInvoiceDTO
     */
    public function setInvoiceDate(string $invoiceDate): HCInvoiceDTO
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPayUpTo(): ?string
    {
        return $this->payUpTo;
    }

    /**
     * @param string $payUpTo
     * @return HCInvoiceDTO
     */
    public function setPayUpTo(string $payUpTo): HCInvoiceDTO
    {
        $this->payUpTo = $payUpTo;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return HCInvoiceDTO
     */
    public function setStatus(string $status): HCInvoiceDTO
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSeries(): ?string
    {
        return $this->series;
    }

    /**
     * @param string $series
     * @return HCInvoiceDTO
     */
    public function setSeries(string $series): HCInvoiceDTO
    {
        $this->series = $series;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSequence(): ?string
    {
        return $this->sequence;
    }

    /**
     * @param string $sequence
     * @return HCInvoiceDTO
     */
    public function setSequence(string $sequence): HCInvoiceDTO
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrimaryCurrency(): string
    {
        if ($this->primaryCurrency) {
            return $this->primaryCurrency;
        }

        return 'EUR';
    }

    /**
     * @param string $primaryCurrency
     * @return HCInvoiceDTO
     */
    public function setPrimaryCurrency(string $primaryCurrency): HCInvoiceDTO
    {
        $this->primaryCurrency = $primaryCurrency;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getSellerableId(): ?string
    {
        return $this->sellerableId;
    }

    /**
     * @param string $sellerableId
     * @return HCInvoiceDTO
     */
    public function setSellerableId(string $sellerableId): HCInvoiceDTO
    {
        $this->sellerableId = $sellerableId;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getSellerableType(): ?string
    {
        return $this->sellerableType;
    }

    /**
     * @param string $sellerableType
     * @return HCInvoiceDTO
     */
    public function setSellerableType(string $sellerableType): HCInvoiceDTO
    {
        $this->sellerableType = $sellerableType;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getSellerRaw(): ?string
    {
        return $this->sellerRaw;
    }

    /**
     * @param string $sellerRaw
     * @return HCInvoiceDTO
     */
    public function setSellerRaw(string $sellerRaw): HCInvoiceDTO
    {
        $this->sellerRaw = $sellerRaw;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getBuyerableId(): ?string
    {
        return $this->buyerableId;
    }

    /**
     * @param string $buyerableId
     * @return HCInvoiceDTO
     */
    public function setBuyerableId(string $buyerableId): HCInvoiceDTO
    {
        $this->buyerableId = $buyerableId;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getBuyerableType(): ?string
    {
        return $this->buyerableType;
    }

    /**
     * @param string $buyerableType
     * @return HCInvoiceDTO
     */
    public function setBuyerableType(string $buyerableType): HCInvoiceDTO
    {
        $this->buyerableType = $buyerableType;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getBuyerRaw(): ?string
    {
        return $this->buyerRaw;
    }

    /**
     * @param string $buyerRaw
     * @return HCInvoiceDTO
     */
    public function setBuyerRaw(string $buyerRaw): HCInvoiceDTO
    {
        $this->buyerRaw = $buyerRaw;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return HCInvoiceDTO
     */
    public function setAmount(float $amount): HCInvoiceDTO
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        return $this->vat;
    }

    /**
     * @param float $vat
     * @return HCInvoiceDTO
     */
    public function setVat(float $vat): HCInvoiceDTO
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return float
     */
    public function getAmountTotal(): float
    {
        return $this->amountTotal;
    }

    /**
     * @param float $amountTotal
     * @return HCInvoiceDTO
     */
    public function setAmountTotal(float $amountTotal): HCInvoiceDTO
    {
        $this->amountTotal = $amountTotal;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethod(): ?string
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     * @return HCInvoiceDTO
     */
    public function setPaymentMethod(string $paymentMethod): HCInvoiceDTO
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return HCInvoiceDTO
     */
    public function setItems(array $items): HCInvoiceDTO
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'invoice_date' => $this->getInvoiceDate(),
            'pay_up_to' => $this->getPayUpTo(),
            'status' => $this->getStatus(),
            'series' => $this->getSeries(),
            'sequence' => $this->getSequence(),
            'primary_currency' => $this->getPrimaryCurrency(),
            'sellerable_id' => $this->getSellerableId(),
            'sellerable_type' => $this->getSellerableType(),
            'seller_raw' => $this->getSellerRaw(),
            'buyerable_id' => $this->getBuyerableId(),
            'buyerable_type' => $this->getBuyerableType(),
            'buyer_raw' => $this->getBuyerRaw(),
            'amount' => $this->getAmount(),
            'vat' => $this->getVat(),
            'amount_total' => $this->getAmountTotal(),
            'payment_method' => $this->getPaymentMethod(),
            'items' => $this->getItems(),
        ];
    }
}
