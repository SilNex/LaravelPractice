<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class FileUploadTest extends TestCase
{
    /** @test */
    public function fileupload_test () {
        Storage::fake('fake-local');
    
        $response = $this->put('/fileupload', [
            'test' => $file = UploadedFile::fake()->image('test.jpg')
        ]);

        dump(Storage::disk('fake-local'));

        Storage::disk('fake-local')->assertExists('test_files', $file->hashName());
    }
}
