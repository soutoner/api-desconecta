<?php

/**
 *  @SWG\Swagger(
 *      swagger="2.0",
 *      schemes={"http"},
 *      host="localhost:8000",
 *      basePath="/api/v1",
 *      produces={"application/json"},
 *      @SWG\Info(
 *          version="1.0.0",
 *          title="Desconecta API",
 *          description="This is desconecta APi documentation.",
 *          termsOfService="",
 *          @SWG\Contact(
 *              email="contact@desconecta.com"
 *          )
 *      ),
 *      @SWG\Definition(
 *          definition="ErrorResponse",
 *          required={"status","messages"},
 *          @SWG\Property(
 *              property="status",
 *              type="string",
 *          ),
 *          @SWG\Property(
 *              property="messages",
 *              type="string",
 *          ),
 *      ),
 *      @SWG\Definition(
 *          definition="SuccessResponse",
 *          required={"status"},
 *          @SWG\Property(
 *              property="status",
 *              type="string",
 *          ),
 *      ),
 *  ),
 */
