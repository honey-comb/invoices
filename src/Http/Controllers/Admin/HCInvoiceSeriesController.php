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
use HoneyComb\Invoices\Services\Admin\HCInvoiceSeriesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HCInvoiceSeriesController
 * @package HoneyComb\Invoices\Http\Controllers\Admin
 */
class HCInvoiceSeriesController extends HCBaseController
{
    use HCAdminListHeaders;

    /**
     * @var HCInvoiceSeriesService
     */
    protected $service;

    /**
     * HCInvoiceSeriesController constructor.
     * @param HCInvoiceSeriesService $service
     */
    public function __construct(HCInvoiceSeriesService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $config = [
            'title' => trans('HCInvoices::invoices_series.page_title'),
            'url' => route('admin.api.invoices.series'),
            'form' => route('admin.api.form-manager', ['invoices.series']),
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
            'id' => $this->headerText(trans('HCInvoices::invoices_series.id')),
            'padding' => $this->headerText(trans('HCInvoices::invoices_series.padding')),
            'sequence' => $this->headerText(trans('HCInvoices::invoices_series.sequence')),
        ];

        return $columns;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getListPaginate(Request $request): JsonResponse
    {
        return response()->json(
            $this->service->getRepository()->getListPaginate($request)
        );
    }
}
