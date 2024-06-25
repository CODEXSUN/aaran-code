<?php

use Illuminate\Support\Facades\Route;

//testing
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/test-action-file', App\Livewire\Testing\TestingModule\ActionFile::class)->name('test-action-file');
    Route::get('/testing', App\Livewire\Testing\TestingModule\Index::class)->name('testing');
    Route::get('/testing/{id}/modal', App\Livewire\Testing\TestingModule\TestModal::class)->name('testing.modal');
    Route::get('/modal/{id}/action', App\Livewire\Testing\TestingModule\TestAction::class)->name('modal.action');
    Route::get('/action/{id}/{modals_id}/operation', App\Livewire\Testing\TestingModule\TestOperation::class)->name('action.operation');
    Route::get('/operation/{id}/reply', App\Livewire\Testing\TestingModule\TestReply::class)->name('operation.reply');

    Route::get('/base', App\Livewire\Testing\TestingModule\Base::class)->name('base');
    Route::get('/base/{id}/sub', App\Livewire\Testing\TestingModule\Sub::class)->name('base.sub');
    Route::get('/sub/{id}/test_case', App\Livewire\Testing\TestingModule\TestCases::class)->name('sub.test-case');

    Route::get('/module', App\Livewire\Testing\SystemTesting\ModuleSys::class)->name('module');
    Route::get('/module/{id}/db', App\Livewire\Testing\SystemTesting\DatabaseSys::class)->name('module.db');
    Route::get('/db/{id}/admin', App\Livewire\Testing\SystemTesting\AdminSys::class)->name('db.admin');
    Route::get('/admin/{id}/software', App\Livewire\Testing\SystemTesting\SoftwareSys::class)->name('admin.software');
    Route::get('/software/{id}/livewire_class', App\Livewire\Testing\SystemTesting\ClassSys::class)->name('software.livewire-class');
    Route::get('/livewire_class/{id}/livewire_blade', App\Livewire\Testing\SystemTesting\BladeSys::class)->name('livewire-class.livewire-blade');
    Route::get('/livewire_blade/{id}/menu', App\Livewire\Testing\SystemTesting\MenuSys::class)->name('livewire-blade.menu');
});
