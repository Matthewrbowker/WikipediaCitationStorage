<?php

namespace Matthewrbowker\WikipediaCitationStorage\templates;

use Matthewrbowker\WikipediaCitationStorage\templates\CiteTemplateBase;

class CiteWeb extends CiteTemplateBase
{
    protected string $name = "web";

    protected array $allowedParameters = [
        "url",
        "title",
        "author",
        "date",
        "access-date",
        "website",
        "publisher",
        "archive-url",
        "archive-date",
        "dead-url",
        "dead-url",
        "url-status",
        "url-access"
    ];

    protected array $requiredParameters = [
        "url",
        "title"
    ];

    public function getErrorsForTemplate(): array
    {
        // TODO: Implement getErrorsForTemplate() method.
        return [];
    }
}