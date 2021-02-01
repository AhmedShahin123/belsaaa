<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\InvalidBase64Data;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;

class Base64File
{
    protected function convertBase64ToUploadedFile($base64data)
    {
        // strip out data uri scheme information (see RFC 2397)
        if (strpos($base64data, ';base64') !== false) {
            [$_, $base64data] = explode(';', $base64data);
            [$_, $base64data] = explode(',', $base64data);
        }

        // strict mode filters for non-base64 alphabet characters
        if (base64_decode($base64data, true) === false) {
            throw InvalidBase64Data::create();
        }

        // decoding and then reencoding should not change the data
        if (base64_encode(base64_decode($base64data)) !== $base64data) {
            throw InvalidBase64Data::create();
        }

        $binaryData = base64_decode($base64data);

        // temporarily store the decoded data on the filesystem to be able to pass it to the fileAdder
        $tmpFile = tempnam(sys_get_temp_dir(), 'medialibrary');
        file_put_contents($tmpFile, $binaryData);

        $tmpFile = new File($tmpFile);

        return new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @param $parameters
     * @param $validator
     *
     * @return bool
     */
    public function validate(string $attribute, $value, $parameters, $validator): bool
    {
        try {
            $file = $this->convertBase64ToUploadedFile($value);

            Validator::make(['file' => $file], ['file' => 'file:'.implode(',', $parameters)]);

            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
