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
     * @var array|null
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
     * @var array|null
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
     * @var float
     */
    private $totalPrice;

    /**
     * @var float
     */
    private $totalPriceBeforeTax;

    /**
     * @var float
     */
    private $totalPriceTaxAmount;

    /**
     * @var float
     */
    private $totalDiscount;

    /**
     * @var float
     */
    private $totalDiscountBeforeTax;

    /**
     * @var float
     */
    private $totalDiscountTaxAmount;

    /**
     * @var float
     */
    private $finalPrice;

    /**
     * @var float
     */
    private $finalPriceBeforeTax;

    /**
     * @var float
     */
    private $finalPriceTaxAmount;

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
     * @return array|null
     */
    public function getSellerRaw(): ?array
    {
        return $this->sellerRaw;
    }

    /**
     * @param array $sellerRaw
     * @return HCInvoiceDTO
     */
    public function setSellerRaw(array $sellerRaw): HCInvoiceDTO
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
    public function getBuyerRaw(): ?array
    {
        return $this->buyerRaw;
    }

    /**
     * @param array $buyerRaw
     * @return HCInvoiceDTO
     */
    public function setBuyerRaw(array $buyerRaw): HCInvoiceDTO
    {
        $this->buyerRaw = $buyerRaw;

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
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice ?? 0.0;
    }

    /**
     * @param float $totalPrice
     * @return HCInvoiceDTO
     */
    public function setTotalPrice(float $totalPrice): HCInvoiceDTO
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPriceBeforeTax(): float
    {
        return $this->totalPriceBeforeTax ?? 0.0;
    }

    /**
     * @param float $totalPriceBeforeTax
     * @return HCInvoiceDTO
     */
    public function setTotalPriceBeforeTax(float $totalPriceBeforeTax): HCInvoiceDTO
    {
        $this->totalPriceBeforeTax = $totalPriceBeforeTax;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPriceTaxAmount(): float
    {
        return $this->totalPriceTaxAmount ?? 0.0;
    }

    /**
     * @param float $totalPriceTaxAmount
     * @return HCInvoiceDTO
     */
    public function setTotalPriceTaxAmount(float $totalPriceTaxAmount): HCInvoiceDTO
    {
        $this->totalPriceTaxAmount = $totalPriceTaxAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalDiscount(): float
    {
        return $this->totalDiscount ?? 0.0;
    }

    /**
     * @param float $totalDiscount
     * @return HCInvoiceDTO
     */
    public function setTotalDiscount(float $totalDiscount): HCInvoiceDTO
    {
        $this->totalDiscount = $totalDiscount;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalDiscountBeforeTax(): float
    {
        return $this->totalDiscountBeforeTax ?? 0.0;
    }

    /**
     * @param float $totalDiscountBeforeTax
     * @return HCInvoiceDTO
     */
    public function setTotalDiscountBeforeTax(float $totalDiscountBeforeTax): HCInvoiceDTO
    {
        $this->totalDiscountBeforeTax = $totalDiscountBeforeTax;

        return $this;
    }

    /**
     * @return float
     */
    public function getTotalDiscountTaxAmount(): float
    {
        return $this->totalDiscountTaxAmount ?? 0.0;
    }

    /**
     * @param float $totalDiscountTaxAmount
     * @return HCInvoiceDTO
     */
    public function setTotalDiscountTaxAmount(float $totalDiscountTaxAmount): HCInvoiceDTO
    {
        $this->totalDiscountTaxAmount = $totalDiscountTaxAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getFinalPrice(): float
    {
        return $this->finalPrice ?? 0.0;
    }

    /**
     * @param float $finalPrice
     * @return HCInvoiceDTO
     */
    public function setFinalPrice(float $finalPrice): HCInvoiceDTO
    {
        $this->finalPrice = $finalPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getFinalPriceBeforeTax(): float
    {
        return $this->finalPriceBeforeTax ?? 0.0;
    }

    /**
     * @param float $finalPriceBeforeTax
     * @return HCInvoiceDTO
     */
    public function setFinalPriceBeforeTax(float $finalPriceBeforeTax): HCInvoiceDTO
    {
        $this->finalPriceBeforeTax = $finalPriceBeforeTax;

        return $this;
    }

    /**
     * @return float
     */
    public function getFinalPriceTaxAmount(): float
    {
        return $this->finalPriceTaxAmount ?? 0.0;
    }

    /**
     * @param float $finalPriceTaxAmount
     * @return HCInvoiceDTO
     */
    public function setFinalPriceTaxAmount(float $finalPriceTaxAmount): HCInvoiceDTO
    {
        $this->finalPriceTaxAmount = $finalPriceTaxAmount;

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
            'payment_method' => $this->getPaymentMethod(),

            'total_price' => $this->getTotalPrice(),
            'total_price_before_tax' => $this->getTotalPriceBeforeTax(),
            'total_price_tax_amount' => $this->getTotalPriceTaxAmount(),

            'total_discount' => $this->getTotalDiscount(),
            'total_discount_before_tax' => $this->getTotalDiscountBeforeTax(),
            'total_discount_tax_amount' => $this->getTotalDiscountTaxAmount(),

            'final_price' => $this->getFinalPrice(),
            'final_price_before_tax' => $this->getFinalPriceBeforeTax(),
            'final_price_tax_amount' => $this->getFinalPriceTaxAmount(),

            'items' => $this->getItems(),
        ];
    }
}
