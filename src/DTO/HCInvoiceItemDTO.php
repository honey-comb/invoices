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
 * Class HCInvoiceItemDTO
 * @package HoneyComb\Invoices\DTO
 */
class HCInvoiceItemDTO extends HCBaseDTO
{
    /**
     * @var string
     */
    private $invoiceId;

    /**
     * @var string
     */
    private $label;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var string|null
     */
    private $unitType;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var float
     */
    private $discount;

    /**
     * @var float
     */
    private $amount;
    /**
     * @var float
     */
    private $vat;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $discountTotal;

    /**
     * @var float
     */
    private $vatTotal;

    /**
     * @var float
     */
    private $amountTotal;

    /**
     * @return string|null
     */
    public function getInvoiceId(): ?string
    {
        return $this->invoiceId;
    }

    /**
     * @param string $invoiceId
     * @return HCInvoiceItemDTO
     */
    public function setInvoiceId(string $invoiceId): HCInvoiceItemDTO
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return HCInvoiceItemDTO
     */
    public function setLabel(string $label): HCInvoiceItemDTO
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     * @return HCInvoiceItemDTO
     */
    public function setQuantity(float $quantity): HCInvoiceItemDTO
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return string|nullable
     */
    public function getUnitType(): ?string
    {
        return $this->unitType;
    }

    /**
     * @param string $unitType
     * @return HCInvoiceItemDTO
     */
    public function setUnitType(string $unitType): HCInvoiceItemDTO
    {
        $this->unitType = $unitType;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     * @return HCInvoiceItemDTO
     */
    public function setUnitPrice(float $unitPrice): HCInvoiceItemDTO
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount ?? 0.00;
    }

    /**
     * @param float $discount
     * @return HCInvoiceItemDTO
     */
    public function setDiscount(float $discount): HCInvoiceItemDTO
    {
        $this->discount = $discount;

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
     * @return HCInvoiceItemDTO
     */
    public function setAmount(float $amount): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setVat(float $vat): HCInvoiceItemDTO
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency ?? 'EUR';
    }

    /**
     * @param string $currency
     * @return HCInvoiceItemDTO
     */
    public function setCurrency(string $currency): HCInvoiceItemDTO
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscountTotal(): float
    {
        return $this->discountTotal ?? 0;
    }

    /**
     * @param float $discountTotal
     * @return HCInvoiceItemDTO
     */
    public function setDiscountTotal(float $discountTotal): HCInvoiceItemDTO
    {
        $this->discountTotal = $discountTotal;

        return $this;
    }

    /**
     * @return float
     */
    public function getVatTotal(): float
    {
        return $this->vatTotal;
    }

    /**
     * @param float $vatTotal
     * @return HCInvoiceItemDTO
     */
    public function setVatTotal(float $vatTotal): HCInvoiceItemDTO
    {
        $this->vatTotal = $vatTotal;

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
     * @return HCInvoiceItemDTO
     */
    public function setAmountTotal(float $amountTotal): HCInvoiceItemDTO
    {
        $this->amountTotal = $amountTotal;

        return $this;
    }

    /**
     * @return array
     */
    protected function jsonData(): array
    {
        return [
            'invoice_id' => $this->getInvoiceId(),
            'label' => $this->getLabel(),
            'quantity' => $this->getQuantity(),
            'unit_type' => $this->getUnitType(),
            'unit_price' => $this->getUnitPrice(),
            'discount' => $this->getDiscount(),
            'amount' => $this->getAmount(),
            'vat' => $this->getVat(),
            'currency' => $this->getCurrency(),
            'discount_total' => $this->getDiscountTotal(),
            'vat_total' => $this->getVatTotal(),
            'amount_total' => $this->getAmountTotal(),
        ];
    }
}
