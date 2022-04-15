<?php

namespace ShakilAhmmed\ImageUploader\Authentication\Actions;

use ShakilAhmmed\ImageUploader\Authentication\PackageConst;

class TokenGenerateAction
{
    public function handle(): array
    {
        $tokenGenerate = auth()->user()->createToken(PackageConst::TOKEN_NAME);
        $accessToken = $tokenGenerate->accessToken;
        return [$tokenGenerate, $accessToken];
    }
}
