<?php

it('provides translations', function () {
    $this->assertTranslationExists('cookies_consent::messages.title');
    $this->assertTranslationExists('cookies_consent::messages.body');
});
