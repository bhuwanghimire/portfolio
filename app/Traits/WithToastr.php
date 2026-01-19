<?php

namespace App\Traits;

trait WithToastr
{
    public function toast($message, $type = 'success')
    {
        $this->dispatch('toast', [
            'message' => $message,
            'type' => $type
        ]);




    }

    public function toastSuccess($message)
    {
        $this->toast($message, 'success');
    }

    public function toastError($message)
    {
        $this->toast($message, 'error');
    }

    public function toastWarning($message)
    {
        $this->toast($message, 'warning');
    }

    public function toastInfo($message)
    {
        $this->toast($message, 'info');
    }
}
