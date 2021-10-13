<?php

namespace App\Support;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\Route;

class FormRequest extends RequestInput
{
    protected $validator;
    protected ResponseInterface $response;

    public function __construct(Request $request, Route $route, ResponseFactoryInterface $factory)
    {
        $this->response = $factory->createResponse(422);
        parent::__construct($request, $route);
    }

    public function validate()
    {
        $this->prepareForValidation();

        $this->validator = validator(
            $this->all(),
            $this->rules(),
            $this->messages()
        );

        if ($this->validator->fails()) {
            $this->afterValidationFails();

            return back();
        }

        if ($this->validator->passes()) {
            $this->afterValidationPasses();
        }

        $this->afterValidation();
    }

    protected function prepareForValidation()
    {
        //
    }

    protected function afterValidationPasses()
    {
        //
    }

    protected function afterValidationFails()
    {
        $this->response->getBody()->write(json_encode($this->validator->errors()));

        return $this->response
            ->withHeader('Content-Type', 'application/json');
    }

    protected function afterValidation()
    {
        //
    }

    public function validator()
    {
        return $this->validator;
    }

    public function failed(): bool
    {
        return $this->validator()->fails();
    }

    public function messages()
    {
        return [];
    }

    public function rules()
    {
        return [];
    }

}
