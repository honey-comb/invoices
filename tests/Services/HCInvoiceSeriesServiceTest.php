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

use HoneyComb\Invoices\Services\Admin\HCInvoiceSeriesService;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class HCInvoiceSeriesServiceTest
 * @package Tests\Services
 */
class HCInvoiceSeriesServiceTest extends TestCase
{
    use RefreshDatabase, InteractsWithDatabase;

    /**
     * @test
     * @group invoice-series-service
     */
    public function it_must_create_singleton_instance(): void
    {
        $this->assertInstanceOf(HCInvoiceSeriesService::class, $this->getTestClassInstance());

        $this->assertSame($this->getTestClassInstance(), $this->getTestClassInstance());
    }

    /**
     * @test
     * @group invoice-series-service
     */
    public function it_must_generate_correct_series_as_string(): void
    {
        $this->assertSame(
            'BR-00001',
            $this->getTestClassInstance()->getInvoiceCode('BR')
        );

        $this->assertSame(
            'BR-00002',
            $this->getTestClassInstance()->getInvoiceCode('BR')
        );

        $this->assertSame(
            'BR-00003',
            $this->getTestClassInstance()->getInvoiceCode('BR')
        );

        $this->assertSame(
            'B A R-00001',
            $this->getTestClassInstance()->getInvoiceCode('B A R')
        );

        $this->assertSame(
            ' -00001',
            $this->getTestClassInstance()->getInvoiceCode(' ')
        );

        $this->assertSame(
            '  -00001',
            $this->getTestClassInstance()->getInvoiceCode('  ')
        );

        $this->assertSame(
            '  -00002',
            $this->getTestClassInstance()->getInvoiceCode('  ')
        );

        \DB::table('hc_invoice_series')->insert(['id' => 'TEST', 'padding' => 2]);

        $this->assertSame(
            'TEST-01',
            $this->getTestClassInstance()->getInvoiceCode('test')
        );

        $this->assertSame(
            'TEST-02',
            $this->getTestClassInstance()->getInvoiceCode('test')
        );
    }

    /**
     * @test
     * @group invoice-series-service
     */
    public function it_must_generate_correct_series_as_array(): void
    {
        $this->assertSame(
            [
            'series' => 'BR',
            'sequence' => '00001',
        ], $this->getTestClassInstance()->getInvoiceCodeAsArray('BR')
        );

        $this->assertSame(
            [
                'series' => 'BR',
                'sequence' => '00002',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('BR')
        );

        $this->assertSame(
            [
                'series' => 'BR',
                'sequence' => '00003',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('BR')
        );

        $this->assertSame(
            [
                'series' => 'B A R',
                'sequence' => '00001',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('B A R')
        );

        $this->assertSame(
            [
                'series' => ' ',
                'sequence' => '00001',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray(' ')
        );

        $this->assertSame(
            [
                'series' => '  ',
                'sequence' => '00001',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('  ')
        );

        $this->assertSame(
            [
                'series' => '  ',
                'sequence' => '00002',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('  ')
        );

        \DB::table('hc_invoice_series')->insert(['id' => 'TEST', 'padding' => 2]);

        $this->assertSame(
            [
                'series' => 'TEST',
                'sequence' => '01',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('test')
        );

        $this->assertSame(
            [
                'series' => 'TEST',
                'sequence' => '02',
            ],
            $this->getTestClassInstance()->getInvoiceCodeAsArray('test')
        );
    }

    /**
     * @return HCInvoiceSeriesService
     */
    private function getTestClassInstance(): HCInvoiceSeriesService
    {
        return $this->app->make(HCInvoiceSeriesService::class);
    }
}
