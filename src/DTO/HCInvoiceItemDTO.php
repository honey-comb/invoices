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
     * @var string
     */
    private $currency;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $taxName;

    /**
     * @var int
     */
    private $taxValue;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var float
     */
    private $unitPriceBeforeTax;

    /**
     * @var float
     */
    private $unitPriceTaxAmount;

    /**
     * @var float
     */
    private $unitDiscount;

    /**
     * @var float
     */
    private $unitDiscountBeforeTax;

    /**
     * @var float
     */
    private $unitDiscountTaxAmount;

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
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     * @return HCInvoiceItemDTO
     */
    public function setType(?string $type): HCInvoiceItemDTO
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaxName(): ?string
    {
        return $this->taxName;
    }

    /**
     * @param string|null $taxName
     * @return HCInvoiceItemDTO
     */
    public function setTaxName(?string $taxName): HCInvoiceItemDTO
    {
        $this->taxName = $taxName;

        return $this;
    }

    /**
     * @return int
     */
    public function getTaxValue(): int
    {
        return $this->taxValue ?? 0;
    }

    /**
     * @param int $taxValue
     * @return HCInvoiceItemDTO
     */
    public function setTaxValue(int $taxValue): HCInvoiceItemDTO
    {
        $this->taxValue = $taxValue;

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
    public function getUnitPriceBeforeTax(): float
    {
        return $this->unitPriceBeforeTax;
    }

    /**
     * @param float $unitPriceBeforeTax
     * @return HCInvoiceItemDTO
     */
    public function setUnitPriceBeforeTax(float $unitPriceBeforeTax): HCInvoiceItemDTO
    {
        $this->unitPriceBeforeTax = $unitPriceBeforeTax;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitPriceTaxAmount(): float
    {
        return $this->unitPriceTaxAmount ?? 0.0;
    }

    /**
     * @param float $unitPriceTaxAmount
     * @return HCInvoiceItemDTO
     */
    public function setUnitPriceTaxAmount(float $unitPriceTaxAmount): HCInvoiceItemDTO
    {
        $this->unitPriceTaxAmount = $unitPriceTaxAmount;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitDiscount(): float
    {
        return $this->unitDiscount ?? 0.0;
    }

    /**
     * @param float $unitDiscount
     * @return HCInvoiceItemDTO
     */
    public function setUnitDiscount(float $unitDiscount): HCInvoiceItemDTO
    {
        $this->unitDiscount = $unitDiscount;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitDiscountBeforeTax(): float
    {
        return $this->unitDiscountBeforeTax ?? 0.0;
    }

    /**
     * @param float $unitDiscountBeforeTax
     * @return HCInvoiceItemDTO
     */
    public function setUnitDiscountBeforeTax(float $unitDiscountBeforeTax): HCInvoiceItemDTO
    {
        $this->unitDiscountBeforeTax = $unitDiscountBeforeTax;

        return $this;
    }

    /**
     * @return float
     */
    public function getUnitDiscountTaxAmount(): float
    {
        return $this->unitDiscountTaxAmount ?? 0.0;
    }

    /**
     * @param float $unitDiscountTaxAmount
     * @return HCInvoiceItemDTO
     */
    public function setUnitDiscountTaxAmount(float $unitDiscountTaxAmount): HCInvoiceItemDTO
    {
        $this->unitDiscountTaxAmount = $unitDiscountTaxAmount;

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
     * @return HCInvoiceItemDTO
     */
    public function setTotalPrice(float $totalPrice): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setTotalPriceBeforeTax(float $totalPriceBeforeTax): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setTotalPriceTaxAmount(float $totalPriceTaxAmount): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setTotalDiscount(float $totalDiscount): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setTotalDiscountBeforeTax(float $totalDiscountBeforeTax): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setTotalDiscountTaxAmount(float $totalDiscountTaxAmount): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setFinalPrice(float $finalPrice): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setFinalPriceBeforeTax(float $finalPriceBeforeTax): HCInvoiceItemDTO
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
     * @return HCInvoiceItemDTO
     */
    public function setFinalPriceTaxAmount(float $finalPriceTaxAmount): HCInvoiceItemDTO
    {
        $this->finalPriceTaxAmount = $finalPriceTaxAmount;

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
            'type' => $this->getType(), // product, shipping, deposit
            'unit_type' => $this->getUnitType(),
            'currency' => $this->getCurrency(),

            'tax_name' => $this->getTaxName(),
            'tax_value' => $this->getTaxValue(),

            'unit_price' => $this->getUnitPrice(),
            'unit_price_before_tax' => $this->getUnitPriceBeforeTax(),
            'unit_price_tax_amount' => $this->getUnitPriceTaxAmount(),

            'unit_discount' => $this->getUnitDiscount(),
            'unit_discount_before_tax' => $this->getUnitDiscountBeforeTax(),
            'unit_discount_tax_amount' => $this->getUnitDiscountTaxAmount(),

            'total_price' => $this->getTotalPrice(),
            'total_price_before_tax' => $this->getTotalPriceBeforeTax(),
            'total_price_tax_amount' => $this->getTotalPriceTaxAmount(),

            'total_discount' => $this->getTotalDiscount(),
            'total_discount_before_tax' => $this->getTotalDiscountBeforeTax(),
            'total_discount_tax_amount' => $this->getTotalDiscountTaxAmount(),

            'final_price' => $this->getFinalPrice(),
            'final_price_before_tax' => $this->getFinalPriceBeforeTax(),
            'final_price_tax_amount' => $this->getFinalPriceTaxAmount(),
        ];
    }
}
