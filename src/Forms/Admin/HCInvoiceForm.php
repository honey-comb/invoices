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

namespace HoneyComb\Invoices\Forms\Admin;

use HoneyComb\Starter\Forms\HCBaseForm;

/**
 * Class HCInvoiceForm
 * @package HoneyComb\Invoices\Forms\Admin
 */
class HCInvoiceForm extends HCBaseForm
{
    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     * @throws \Illuminate\Container\EntryNotFoundException
     */
    public function createForm(bool $edit = false): array
    {
        $form = [
            'storageUrl' => route('admin.api.invoices'),
            'buttons' => [
                'submit' => [
                    'label' => $this->getSubmitLabel($edit),
                ],
            ],
            'structure' => $this->getStructure($edit),
        ];

        if ($this->multiLanguage) {
            $form['availableLanguages'] = getHCContentLanguages();
        }

        return $form;
    }

    /**
     * @param string $prefix
     * @return array
     */
    public function getStructureNew(string $prefix): array
    {
        return [
            $prefix . 'invoice_date' => [
                'type' => 'dateTimePicker',
                'label' => trans('HCInvoices::invoices.invoice_date'),

            ],
            $prefix . 'pay_up_to' => [
                'type' => 'dateTimePicker',
                'label' => trans('HCInvoices::invoices.pay_up_to'),

            ],
            $prefix . 'status' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.status'),
                'required' => 1,
            ],
            $prefix . 'series' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.series'),

            ],
            $prefix . 'sequence' => [
                'type' => 'number',
                'label' => trans('HCInvoices::invoices.sequence'),

            ],
            $prefix . 'primary_currency' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.primary_currency'),
                'required' => 1,
            ],
            $prefix . 'sellerable_id' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.sellerable_id'),

            ],
            $prefix . 'sellerable_type' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.sellerable_type'),

            ],
            $prefix . 'seller_raw' => [
                'type' => 'richText',
                'label' => trans('HCInvoices::invoices.seller_raw'),

            ],
            $prefix . 'buyerable_id' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.buyerable_id'),

            ],
            $prefix . 'buyerable_type' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.buyerable_type'),

            ],
            $prefix . 'buyer_raw' => [
                'type' => 'richText',
                'label' => trans('HCInvoices::invoices.buyer_raw'),

            ],
            $prefix . 'payment_method' => [
                'type' => 'singleLine',
                'label' => trans('HCInvoices::invoices.payment_method'),
            ],
        ];
    }

    /**
     * @param string $prefix
     * @return array
     */
    public function getStructureEdit(string $prefix): array
    {
        return $this->getStructureNew($prefix);
    }
}
