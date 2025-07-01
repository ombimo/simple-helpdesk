<?php

namespace App\Filament\Actions;

use App\Enums\MysqlErrorCode;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DeleteActionWithCatch extends DeleteAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (): void {
            try {
                $result = $this->process(static fn (Model $record) => $record->delete());
            } catch (QueryException $th) {
                $result = false;
                switch ($th->getCode()) {
                    case MysqlErrorCode::INTEGRITY_CONSTRAINT_VIOLATION->value:
                        Notification::make()
                            ->title('Terjadi Kesalahan')
                            ->body('Untuk menjaga integritas data, data tidak boleh di hapus')
                            ->danger()
                            ->send();
                        break;

                    default:
                        Log::info($th->getMessage());
                        break;
                }

            }

            if (! $result) {
                $this->failure();

                return;
            }

            $this->success();
        });
    }
}
