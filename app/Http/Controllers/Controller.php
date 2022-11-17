<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(title="SeamLabs APIs", version="0.1")
 *  @OA\PathItem(
 *      path="/"
 *  )
 * @OAS\SecurityScheme(
 *      securityScheme="sanctum",
 *      type="apiKey",
 *      scheme="bearer"
 * )
 * @OA\SecurityScheme(
 *          securityScheme="sanctum",
 *          type="apiKey",
 *          in="header",
 *          name="Authorization"
 *      )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
