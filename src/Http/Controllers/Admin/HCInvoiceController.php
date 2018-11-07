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

namespace HoneyComb\Invoices\Http\Controllers\Admin;

use HoneyComb\Core\Http\Controllers\HCBaseController;
use HoneyComb\Core\Http\Controllers\Traits\HCAdminListHeaders;
use HoneyComb\Invoices\Http\Requests\Admin\HCInvoiceRequest;
use HoneyComb\Invoices\Models\HCInvoice;
use HoneyComb\Invoices\Services\Admin\HCInvoiceService;
use HoneyComb\Starter\Helpers\HCFrontendResponse;
use Illuminate\Database\Connection;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

/**
 * Class HCInvoiceController
 * @package HoneyComb\Invoices\Http\Controllers\Admin
 */
class HCInvoiceController extends HCBaseController
{
    use HCAdminListHeaders;

    /**
     * @var HCInvoiceService
     */
    protected $service;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var HCFrontendResponse
     */
    private $response;

    /**
     * HCInvoiceController constructor.
     * @param Connection $connection
     * @param HCFrontendResponse $response
     * @param HCInvoiceService $service
     */
    public function __construct(Connection $connection, HCFrontendResponse $response, HCInvoiceService $service)
    {
        $this->connection = $connection;
        $this->response = $response;
        $this->service = $service;
    }

    /**
     * Admin panel page view
     *
     * @return View
     */
    public function index(): View
    {
        $config = [
            'title' => trans('HCInvoices::invoices.page_title'),
            'url' => route('admin.api.invoices'),
            'form' => route('admin.api.form-manager', ['invoices']),
            'headers' => $this->getTableColumns(),
            'actions' => ['search'],
        ];

        return view('HCCore::admin.service.index', ['config' => $config]);
    }

    /**
     * Get admin page table columns settings
     *
     * @return array
     */
    public function getTableColumns(): array
    {
        $columns = [
            'invoice_date' => $this->headerText(trans('HCInvoices::invoices.invoice_date')),
            'pay_up_to' => $this->headerText(trans('HCInvoices::invoices.pay_up_to')),
            'status' => $this->headerText(trans('HCInvoices::invoices.status')),
            'series' => $this->headerText(trans('HCInvoices::invoices.series')),
            'sequence' => $this->headerText(trans('HCInvoices::invoices.sequence')),
            'primary_currency' => $this->headerText(trans('HCInvoices::invoices.primary_currency')),
            'sellerable_id' => $this->headerText(trans('HCInvoices::invoices.sellerable_id')),
            'sellerable_type' => $this->headerText(trans('HCInvoices::invoices.sellerable_type')),
            'seller_raw' => $this->headerText(trans('HCInvoices::invoices.seller_raw')),
            'buyerable_id' => $this->headerText(trans('HCInvoices::invoices.buyerable_id')),
            'buyerable_type' => $this->headerText(trans('HCInvoices::invoices.buyerable_type')),
            'buyer_raw' => $this->headerText(trans('HCInvoices::invoices.buyer_raw')),
            'amount' => $this->headerText(trans('HCInvoices::invoices.amount')),
            'vat' => $this->headerText(trans('HCInvoices::invoices.vat')),
            'amount_total' => $this->headerText(trans('HCInvoices::invoices.amount_total')),
            'discount_total' => $this->headerText(trans('HCInvoices::invoices.discount_total')),
            'vat_total' => $this->headerText(trans('HCInvoices::invoices.vat_total')),
            'payment_method' => $this->headerText(trans('HCInvoices::invoices.payment_method')),
        ];

        return $columns;
    }

    /**
     * Creating data list
     * @param HCInvoiceRequest $request
     * @return JsonResponse
     */
    public function getListPaginate(HCInvoiceRequest $request): JsonResponse
    {
        return response()->json(
            $this->service->getRepository()->getListPaginate($request)
        );
    }
}
