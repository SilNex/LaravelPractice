<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;

class FileUploadTest extends TestCase
{
    /** @test */
    public function fileupload_test () {
        Storage::fake('test');
    
        $response = $this->put('/fileupload', [
            'test' => $file = UploadedFile::fake()->image('test.jpg')
        ]);

        dump(Storage::disk('test'));

        Storage::disk('test')->assertExists('test_files', $file->hashName());
    }
}
