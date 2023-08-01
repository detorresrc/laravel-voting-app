<?php
namespace App\Http\Livewire\Traits;

trait WithAuthRedirects
{
    public function redirectToLoginPage()
    {
        redirect()->setIntendedUrl(url()->previous());
        return redirect()->route('login');
    }
}
