<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Models\Product;
use Phalcon\Http\Response;
use App\Exceptions\ResourceNotFoundException;

class ProductsController extends BaseController
{
    /**
     * Returns all the products in the database.
     */
    public function index()
    {
        return $this->paginate();
    }

    /**
     * Creates a product in the database.
     *
     * @return Response
     */
    public function create()
    {
        $request = $this->request;

        $product = new Product();
        $product->assign(
            [
            'name' => $request->get('name', 'string'),
            'icon' => $request->get('icon', 'strint'),
            ]
        );

        return $this->response($request, $product, true);
    }

    /**
     * Updates a product. Always use `x-www-form-urlencoded` content type for PUT.
     * @param $id - Id of the event to be updated
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function update($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $request = $this->request;

            $product = Product::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            $product->assign(
                [
                'id'               => $id,
                'name'             => $request->getPut('name', 'string', $product->name),
                'icon'             => $request->getPut('name', 'string', $product->icon),
                ]
            );

            return $this->response($request, $product, true);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    /**
     * Deletes a product from the database.
     *
     * @param  $id - Id of the pack to be deleted
     * @return Response
     * @throws ResourceNotFoundException
     */
    public function delete($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {

            $product = Product::findFirstOrFail(
                [
                'id = ?0', 'bind' => [$id]
                ]
            );

            return $this->response($this->request, $product);

        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
