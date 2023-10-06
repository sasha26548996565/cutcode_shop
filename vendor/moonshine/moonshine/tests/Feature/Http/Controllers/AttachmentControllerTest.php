<?php


use Illuminate\Http\UploadedFile;

uses()->group('controllers');

beforeEach(function (): void {
    Storage::fake('public');
});

it('successful upload', function (): void {
    $file = UploadedFile::fake()->image('attachment.jpg');

    asAdmin()
        ->post(route('moonshine.attachments'), ['file' => $file]);

    Storage::disk('public')->assertExists('attachments/' . $file->hashName());
});
