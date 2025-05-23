<?php

namespace Ramez\PhpMvcCore\Form;

use Ramez\PhpMvcCore\Model;

class Field {
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_NUMBER = 'number';



    public Model $model;
    public string $attribute;
    public string $type;

    public function __construct(Model $model, string $attribute) {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString() {
        $errorClass = $this->model->hasError($this->attribute) ? ' is-danger' : '';
        $value = htmlspecialchars($this->model->{$this->attribute} ?? '');
        $errorMessage = $this->model->hasError($this->attribute) ? $this->model->getErrorMessage($this->attribute) : '';


        return "
            <div class='field'>
                <label class='label'>{$this->model->getlabel($this->attribute)}</label>
                <div class='control'>
                    <input class='input{$errorClass}' value='{$value}' type='{$this->type}' name='{$this->attribute}'>
                </div>
                " . ($errorMessage ? "<p class='help is-danger'>{$errorMessage}</p>" : "") . "
            </div>
        ";
    }

    public function passwordField(){
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField(){
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function numberField(){
        $this->type = self::TYPE_NUMBER;
        return $this;
    }
}