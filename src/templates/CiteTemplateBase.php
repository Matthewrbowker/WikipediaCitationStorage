<?php

namespace Matthewrbowker\WikipediaCitationStorage\templates;

abstract class CiteTemplateBase
{
    protected string $name;

    protected array $allowedParameters = [];
    protected array $requiredParameters = [];

    protected array $parameters = [];

    // Holds errors that were generated during parsing
    protected array $errors = [];

    public function __set(string $name, $value): void
    {
        if(!in_array($name, $this->allowedParameters)) {
            $this->errors[] = "Unknown parameter $name ignored.";
        }
        $this->parameters[$name] = $value;
    }

    // Contains errors that are common to all templates, this is also post-parse
    protected function getErrorsCommonToAllTemplates() {
        $errors = [];
        foreach($this->requiredParameters as $parameter) {
            if(!isset($this->parameters[$parameter])) {
                $errors[] = "Missing parameter: $parameter";
            }
        }
        return $errors;
    }

    // Contains mostly post-parse errors - for example if a parameter is missing that depends on another parameter
    public abstract function getErrorsForTemplate(): array;

    public function getErrors(): array
    {
        return array_merge($this->getErrorsCommonToAllTemplates(), $this->getErrorsForTemplate(), $this->errors);
    }

    public function __toString() {
        $output = "{{cite " . $this->name;
        foreach($this->parameters as $key=>$value) {
            $output .= "|$key=$value";
        }
        $output .= "}}";
        return $output;
    }
}