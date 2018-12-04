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

namespace Tests\Services;

use HoneyComb\Invoices\Enum\HCInvoiceStatusEnum;
use HoneyComb\Invoices\Exceptions\HCInvoiceException;
use HoneyComb\Invoices\Models\HCInvoice;
use HoneyComb\Invoices\Services\Admin\HCInvoiceService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class HCInvoiceServiceTest
 * @package Tests\Services
 */
class HCInvoiceServiceTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_create_singleton_instance(): void
    {
        $this->assertInstanceOf(HCInvoiceService::class, $this->getTestClassInstance());

        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_throw_exception_if_array_not_contains_required_fields(): void
    {
        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('Invoice data missing required fields');

        $this->getTestClassInstance()->createAdvanceInvoice([]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_create_advance_invoice(): void
    {
        $result = $this->getTestClassInstance()->createAdvanceInvoice([
            'primary_currency' => 'EUR',
            'buyer_raw' => 'buyer_raw',
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'items' => [
                [
                    'label' => 'test',
                    'quantity' => 1,
                    'unit_type' => 'kg',
                    'unit_price' => 10.45,
                    'discount' => 0,
                    'amount' => 10.45,
                    'vat' => 2,
                    'amount_total' => 12.45,
                    'currency' => 'EUR',
                ],
            ],
        ]);
        $this->assertInstanceOf(HCInvoice::class, $result);
        $this->assertDatabaseHas('hc_invoice', [
            'primary_currency' => 'EUR',
            'buyer_raw' => 'buyer_raw',
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'status' => 'advanced',
        ]);
        $this->assertDatabaseHas('hc_invoice_item', [
            'label' => 'test',
            'quantity' => 1,
            'unit_type' => 'kg',
            'unit_price' => 10.45,
            'discount' => 0,
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'currency' => 'EUR',
        ]);
        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $result->id,
            'status' => 'advanced',
        ]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_create_issued_invoice(): void
    {
        $result = $this->getTestClassInstance()->createIssueInvoice('HC', [
            'primary_currency' => 'EUR',
            'buyer_raw' => 'buyer_raw',
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'items' => [
                [
                    'label' => 'test',
                    'quantity' => 1,
                    'unit_type' => 'kg',
                    'unit_price' => 10.45,
                    'discount' => 0,
                    'amount' => 10.45,
                    'vat' => 2,
                    'amount_total' => 12.45,
                    'currency' => 'EUR',
                ],
            ],
        ]);

        $this->assertInstanceOf(HCInvoice::class, $result);
        $this->assertDatabaseHas('hc_invoice', [
            'series' => 'HC',
            'sequence' => '00001',
            'primary_currency' => 'EUR',
            'buyer_raw' => 'buyer_raw',
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'status' => 'issued',
        ]);
        $this->assertDatabaseHas('hc_invoice_item', [
            'label' => 'test',
            'quantity' => 1,
            'unit_type' => 'kg',
            'unit_price' => 10.45,
            'discount' => 0,
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'currency' => 'EUR',
        ]);
        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $result->id,
            'status' => 'issued',
        ]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_create_payed_invoice(): void
    {
        $result = $this->getTestClassInstance()->createPayedInvoice('HC', [
            'primary_currency' => 'EUR',
            'buyer_raw' => 'buyer_raw',
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'items' => [
                [
                    'label' => 'test',
                    'quantity' => 1,
                    'unit_type' => 'kg',
                    'unit_price' => 10.45,
                    'discount' => 0,
                    'amount' => 10.45,
                    'vat' => 2,
                    'amount_total' => 12.45,
                    'currency' => 'EUR',
                ],
            ],
        ]);

        $this->assertInstanceOf(HCInvoice::class, $result);
        $this->assertDatabaseHas('hc_invoice', [
            'series' => 'HC',
            'sequence' => '00001',
            'primary_currency' => 'EUR',
            'buyer_raw' => 'buyer_raw',
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'status' => 'payed',
        ]);
        $this->assertDatabaseHas('hc_invoice_item', [
            'label' => 'test',
            'quantity' => 1,
            'unit_type' => 'kg',
            'unit_price' => 10.45,
            'discount' => 0,
            'amount' => 10.45,
            'vat' => 2,
            'amount_total' => 12.45,
            'currency' => 'EUR',
        ]);
        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $result->id,
            'status' => 'payed',
        ]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_change_invoice_status_to_advance(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::payed()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('Incorrect status');
        $this->getTestClassInstance()->changeInvoiceStatus($invoice->id, HCInvoiceStatusEnum::advanced()->id());
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_change_invoice_status_to_issued_without_series_param(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::advanced()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('Series parameter is required!');

        $this->getTestClassInstance()->changeInvoiceStatus($invoice->id, HCInvoiceStatusEnum::issued()->id());
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_change_in_directly_method_invoice_status_to_issued_without_series_param(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::advanced()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('Series parameter is required!');

        $this->getTestClassInstance()->changeStatusToIssued($invoice->id);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_to_change_if_invoice_doesnt_exists(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $this->getTestClassInstance()->changeStatusToIssued('invoice-uuid', 'HC');
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_to_change_to_advanced_if_invoice_status_is_not_advanced(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::payed()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('To change invoice id status to issued invoice status must be advanced');

        $this->getTestClassInstance()->changeStatusToIssued($invoice->id, 'HC');
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_change_status_to_issued_and_generate_series_and_sequence_and_log_to_history(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::advanced()->id(),
            'series' => null,
            'sequence' => null,
        ]);

        $invoice = $this->getTestClassInstance()->changeStatusToIssued($invoice->id, 'HC');

        $this->assertSame('HC', $invoice->series);
        $this->assertSame('00001', $invoice->sequence);
        $this->assertSame(HCInvoiceStatusEnum::issued()->id(), $invoice->status);

        $this->assertDatabaseHas('hc_invoice', [
            'series' => $invoice->series,
            'sequence' => $invoice->sequence,
            'status' => HCInvoiceStatusEnum::issued()->id(),
        ]);

        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $invoice->id,
            'status' => HCInvoiceStatusEnum::issued()->id(),
        ]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_to_change_status_if_invoice_is_already_canceled(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::canceled()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('Invoice is canceled!');

        $this->getTestClassInstance()->changeStatusToPayed($invoice->id, 'HC');
    }


    /**
     * @test
     * @group invoice-service
     */
    public function it_must_change_status_to_payed_from_issued_and_log_to_history(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::issued()->id(),
            'series' => 'HC',
            'sequence' => '00001',
        ]);

        $invoice = $this->getTestClassInstance()->changeStatusToPayed($invoice->id, 'HC');

        $this->assertSame('HC', $invoice->series);
        $this->assertSame('00001', $invoice->sequence);
        $this->assertSame(HCInvoiceStatusEnum::payed()->id(), $invoice->status);

        $this->assertDatabaseHas('hc_invoice', [
            'series' => $invoice->series,
            'sequence' => $invoice->sequence,
            'status' => HCInvoiceStatusEnum::payed()->id(),
        ]);

        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $invoice->id,
            'status' => HCInvoiceStatusEnum::payed()->id(),
        ]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_change_status_to_payed_from_advanced_and_create_issued_between_and_log_to_history(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::advanced()->id(),
        ]);

        $invoice = $this->getTestClassInstance()->changeStatusToPayed($invoice->id, 'HC');

        $this->assertSame('HC', $invoice->series);
        $this->assertSame('00001', $invoice->sequence);
        $this->assertSame(HCInvoiceStatusEnum::payed()->id(), $invoice->status);

        $this->assertDatabaseHas('hc_invoice', [
            'series' => $invoice->series,
            'sequence' => $invoice->sequence,
            'status' => HCInvoiceStatusEnum::payed()->id(),
        ]);

        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $invoice->id,
            'status' => HCInvoiceStatusEnum::issued()->id(),
        ]);

        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $invoice->id,
            'status' => HCInvoiceStatusEnum::payed()->id(),
        ]);
    }

    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_to_cancel_invoice_if_invoice_status_is_not_issued(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::advanced()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('To change status to canceled invoice status must be issued!');

        $this->getTestClassInstance()->changeStatusToCanceled($invoice->id);
    }


    /**
     * @test
     * @group invoice-service
     */
    public function it_must_cancel_issued_invoice_and_log_to_history(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::issued()->id(),
            'series' => 'HC',
            'sequence' => '00001',
        ]);

        $invoice = $this->getTestClassInstance()->changeStatusToCanceled($invoice->id);

        $this->assertSame(HCInvoiceStatusEnum::canceled()->id(), $invoice->status);

        $this->assertDatabaseHas('hc_invoice', [
            'status' => HCInvoiceStatusEnum::canceled()->id(),
        ]);

        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $invoice->id,
            'status' => HCInvoiceStatusEnum::canceled()->id(),
        ]);
    }


    /**
     * @test
     * @group invoice-service
     */
    public function it_must_fail_to_cancel_invoice_status_to_recall_if_invoice_status_is_not_advanced(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::issued()->id(),
        ]);

        $this->expectException(HCInvoiceException::class);
        $this->expectExceptionMessage('To change status to recalled invoice status must be advanced!');

        $this->getTestClassInstance()->changeStatusToRecalled($invoice->id);
    }


    /**
     * @test
     * @group invoice-service
     */
    public function it_must_cancel_advanced_invoice_and_log_to_history(): void
    {
        $invoice = factory(HCInvoice::class)->create([
            'status' => HCInvoiceStatusEnum::advanced()->id(),
        ]);

        $invoice = $this->getTestClassInstance()->changeStatusToRecalled($invoice->id);

        $this->assertSame(HCInvoiceStatusEnum::recalled()->id(), $invoice->status);

        $this->assertDatabaseHas('hc_invoice', [
            'status' => HCInvoiceStatusEnum::recalled()->id(),
        ]);

        $this->assertDatabaseHas('hc_invoice_status_history', [
            'invoice_id' => $invoice->id,
            'status' => HCInvoiceStatusEnum::recalled()->id(),
        ]);
    }

    /**
     * @return HCInvoiceService
     */
    private function getTestClassInstance(): HCInvoiceService
    {
        return $this->app->make(HCInvoiceService::class);
    }
}
