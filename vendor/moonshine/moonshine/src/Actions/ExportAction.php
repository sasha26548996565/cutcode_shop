<?php

declare(strict_types=1);

namespace MoonShine\Actions;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Exceptions\ActionException;
use MoonShine\Jobs\ExportActionJob;
use MoonShine\MoonShineUI;
use MoonShine\Notifications\MoonShineNotification;
use MoonShine\Traits\WithQueue;
use MoonShine\Traits\WithStorage;
use OpenSpout\Common\Exception\InvalidArgumentException;
use OpenSpout\Common\Exception\IOException;
use OpenSpout\Common\Exception\UnsupportedTypeException;
use OpenSpout\Writer\Exception\WriterNotOpenedException;
use Rap2hpoutre\FastExcel\FastExcel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class ExportAction extends Action
{
    use WithStorage;
    use WithQueue;

    protected ?string $icon = 'heroicons.outline.table-cells';

    protected bool $withQuery = true;

    protected bool $isCsv = false;

    protected string $csvDelimiter = ',';

    public function csv(): static
    {
        $this->isCsv = true;

        return $this;
    }

    public function delimiter(string $value): static
    {
        $this->csvDelimiter = $value;

        return $this;
    }

    /**
     * @throws ActionException
     * @throws IOException
     * @throws WriterNotOpenedException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException|Throwable
     */
    public function handle(): RedirectResponse|BinaryFileResponse
    {
        if (is_null($this->resource())) {
            throw new ActionException('Resource is required for action');
        }

        $this->resolveStorage();

        $path = Storage::disk($this->getDisk())
            ->path(
                "{$this->getDir()}/{$this->resource()->routeNameAlias()}." . ($this->isCsv() ? 'csv' : 'xlsx')
            );

        if ($this->isQueue()) {
            ExportActionJob::dispatch(
                $this->resource()::class,
                $path,
                $this->getDisk(),
                $this->getDir(),
                $this->getDelimiter()
            );

            MoonShineUI::toast(
                __('moonshine::ui.resource.queued')
            );

            return back();
        }

        return response()->download(
            self::process(
                $path,
                $this->resource(),
                $this->getDisk(),
                $this->getDir(),
                $this->getDelimiter()
            )
        );
    }

    public function isCsv(): bool
    {
        return $this->isCsv;
    }

    public function getDelimiter(): string
    {
        return $this->csvDelimiter;
    }

    /**
     * @throws WriterNotOpenedException
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws InvalidArgumentException|Throwable
     */
    public static function process(
        string $path,
        ResourceContract $resource,
        string $disk = 'public',
        string $dir = '/',
        string $delimiter = ','
    ): string {
        $fields = $resource->getFields()->exportFields();

        $items = $resource->resolveQuery()->get();

        $data = collect();

        foreach ($items as $item) {
            $row = [];

            foreach ($fields as $field) {
                $row[$field->label()] = $field->exportViewValue($item);
            }

            $data->add($row);
        }

        $fastExcel = new FastExcel($data);

        if (str($path)->contains('.csv')) {
            $fastExcel->configureCsv($delimiter);
        }

        $result = $fastExcel->export($path);

        $url = str($path)
            ->remove(Storage::disk($disk)->path($dir))
            ->value();

        MoonShineNotification::send(
            trans('moonshine::ui.resource.export.exported'),
            [
                'link' => Storage::disk($disk)->url(trim($dir, '/') . $url),
                'label' => trans('moonshine::ui.download'),
            ]
        );

        return $result;
    }
}
