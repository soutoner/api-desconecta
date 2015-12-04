<?php

/**
 * @RoutePrefix("/api/products")
 */
class ProductsController
{

    /**
     * @Get("/")
     */
    public function indexAction()
    {
        return "hola";
    }

}

